$(document).ready(function() {
    var ajaxUrl = $('body').data('ajax-url');

    $('#recipetsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
            { data: 'id', name: 'id' },
            {
                data: 'name_recipets',
                name: 'name_recipets',
                render: function(data) {
                    return data ? data.toUpperCase() : ''; 
                }
            },
            {
                data: 'description_recipets',
                name: 'description_recipets',
                render: function(data) {
                    if (data) {
                        return data.length > 50 ? data.substring(0, 50) + '...' : data;
                    }
                    return '';
                }
            },
            { data: 'quantity_recipets', name: 'quantity_recipets', },
            { data: 'total_recipets', name: 'total_recipets' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <a href="/editDataIndex/${row.id}" class="btn btn-primary">Edit</a>
                        <a href="delete/${row.id}" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    `;
                }
            }
        ],
    });

    var successMessage = message; 
    if (successMessage) {
        Swal.fire({
            title: "Done!",
            text: successMessage, 
            icon: "success"
        });
    }
});