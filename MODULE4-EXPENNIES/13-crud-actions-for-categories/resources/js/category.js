window.addEventListener('DOMContentLoaded', function () {


    this.document.querySelectorAll('.edit-category-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const categoryId = event.currentTarget.getAttribute('data-id');


            console.log(categoryId);
        });
    });
});