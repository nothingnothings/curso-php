const ajax = (url, method = 'get', data = {}, domElement = null) => {
  method = method.toLowerCase();

  let options = {
    method,
    headers: {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
    },
  };

  const csrfMethods = new Set(['post', 'put', 'delete', 'patch']);

  if (csrfMethods.has(method)) {
    if (method !== 'post') {
      options.method = 'post';

      data = { ...data, _METHOD: method.toUpperCase() };
    }
    options.body = JSON.stringify({ ...data, ...getCsrfFields() });
  } else if (method === 'get') {
    url += '?' + new URLSearchParams(data).toString();
  }

  return fetch(url, options).then((response) => {
    if (domElement) {
      clearValidationErrors(domElement);
    }
    if (!response.ok) {
      if (response.status === 422) {
        // Here

        response.json().then((errors) => {
          handleValidationErrors(errors, domElement);
        });
      }
    }
    return response;
  });
};

const get = (url, data) => ajax(url, 'get', data);
const post = (url, data) => ajax(url, 'post', data, domElement);
const del = (url, data) => ajax(url, 'delete', data);

function getCsrfFields() {
  const csrfNameField = document.querySelector('#csrfName');
  const csrfValueField = document.querySelector('#csrfValue');
  const csrfNameKey = csrfNameField.getAttribute('name');
  const csrfName = csrfNameField.content;
  const csrfValueKey = csrfValueField.getAttribute('name');
  const csrfValue = csrfValueField.content;

  return {
    [csrfNameKey]: csrfName,
    [csrfValueKey]: csrfValue,
  };
}

function handleValidationErrors(errors, domElement) {
  for (const name in errors) {
    const element = domElement.querySelector(`[name="${name}"]`);

    element.classList.add('is-invalid');

    for (const error of errors[name]) {
      const errorDiv = document.createElement('div');
      errorDiv.classList.add('invalid-feedback');
      errorDiv.textContent = error;
      element.parentNode.append(errorDiv);
    }
  }
}

function clearValidationErrors(domElement) {
  domElement.querySelector('.is-invalid').forEach((element) => {
    element.classList.remove('is-invalid');
    element.parentNode.querySelector('.invalid-feedback').remove();
  });
}

export { ajax, get, post, del };
