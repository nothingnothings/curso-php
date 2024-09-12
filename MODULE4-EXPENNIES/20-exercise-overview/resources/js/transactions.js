import { Modal } from 'bootstrap';
import { get, post, del } from './ajax';
import DataTable from 'datatables.net';

window.addEventListener('DOMContentLoaded', function () {
  const editTransactionModal = new Modal(
    document.getElementById('editTransactionModal')
  );

  this.fetch('/transactions/load')
    .then((response) => response.json())
    .then((response) => {
      console.log(response);
    });

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
          );
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
          name: editTransactionModal._element.querySelector(
            'input[name="name"]'
          ).value,
        },
        editTransactionModal._element
      ).then((response) => {
        console.log(response, 'THE RESPONSE');
        if (response.ok) {
          table.draw();
          editTransactionModal.hide();
        }
      });
    });
});

function openEditTransactionModal(modal, { id, name }) {
  const nameInput = modal._element.querySelector('input[name="name"]');

  nameInput.value = name;

  modal._element
    .querySelector('.save-transaction-btn')
    .setAttribute('data-id', id);

  modal.show();
}
