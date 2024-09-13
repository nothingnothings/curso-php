import { Modal } from 'bootstrap';
import { get, post, del } from './ajax';
import DataTable from 'datatables.net';

window.addEventListener('DOMContentLoaded', function () {
  const editTransactionModal = new Modal(
    document.getElementById('editTransactionModal')
  );

  const table = new DataTable('#transactionsTable', {
    serverSide: true,
    ajax: '/transactions/load',
    orderMulti: false,
    columns: [
      { data: 'description' },
      { data: 'amount' },
      { data: 'category' },
      { data: 'date' },
      {
        sortable: false,
        data: (row) => `
                    <div class="d-flex flex-">
                        <button type="submit" class="btn btn-outline-primary delete-transaction-btn" data-id="${row.id}">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                        <button class="ms-2 btn btn-outline-primary edit-transaction-btn" data-id="${row.id}">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                    </div>
                `,
      },
    ],
  });

  document
    .querySelector('#transactionsTable')
    .addEventListener('click', function (event) {
      const editBtn = event.target.closest('.edit-transaction-btn');
      const deleteBtn = event.target.closest('.delete-transaction-btn');

      if (editBtn) {
        const transactionId = editBtn.getAttribute('data-id');

        get(`/transactions/${transactionId}`)
          .then((response) => response.json())
          .then((response) =>
            openEditTransactionModal(editTransactionModal, response)
          )
          .catch((error) => console.log(error));
      } else {
        const transactionId = deleteBtn.getAttribute('data-id');

        if (confirm('Are you sure you want to delete this transaction?')) {
          del(`/transactions/${transactionId}`).then((response) => {
            if (response.ok) {
              table.draw();
            }
          });
        }
      }
    });

  document
    .querySelector('.save-transaction-btn')
    .addEventListener('click', function (event) {
      const transactionId = event.currentTarget.getAttribute('data-id');

      post(
        `/transactions/${transactionId}`,
        {
          description: editTransactionModal._element.querySelector(
            'textarea[name="description"]'
          ).value,
          amount: editTransactionModal._element.querySelector(
            'input[name="amount"]'
          ).value,
          category: editTransactionModal._element.querySelector(
            'select[name="category"]'
          ).value,
        },
        editTransactionModal._element
      ).then((response) => {
        if (response.ok) {
          console.log(response, 'THE RESPONSE');
          table.draw();
          editTransactionModal.hide();
        }
      });
    });

  const addNewTransactionBtn = document.getElementById(
    'add-new-transaction-btn'
  );

  addNewTransactionBtn.addEventListener('click', function (event) {
    const categorySelectDropdown = document.getElementById('new-transaction-dropdown');
    const dateInput = document.querySelector('input[name="date"]');

    get('/categories/all')
      .then((response) => response.json())
      .then((categories) => {
        categories.forEach((category) => {
          const option = document.createElement('option');
          option.value = category.id;
          option.text = category.name;
          categorySelectDropdown.appendChild(option);
        });

        dateInput.value = new Date().toISOString().slice(0, 10);
      });
  });
});

function openEditTransactionModal(
  modal,
  { id, description, amount, category, category_id }
) {
  const descriptionInput = modal._element.querySelector(
    'textarea[name="description"]'
  );
  const amountInput = modal._element.querySelector('input[name="amount"]');
  const categoryInput = modal._element.querySelector('select[name="category"]');

  descriptionInput.value = description;
  amountInput.value = amount;

  get('/categories/all')
    .then((response) => response.json())
    .then((categories) => {
      // Create select options programmatically
      const selectOptions = categories.map((cat) => {
        // Check if the current option should be selected
        const isSelected = cat.id === category_id ? 'selected' : '';
        return `<option value="${cat.id}" ${isSelected}>${cat.name}</option>`;
      });

      // Populate the select element with options
      categoryInput.innerHTML = selectOptions.join('');

      // Set the transaction ID on the save button
      modal._element
        .querySelector('.save-transaction-btn')
        .setAttribute('data-id', id);

      modal.show();
    })
    .catch((error) => console.error('Error fetching categories:', error));
}
