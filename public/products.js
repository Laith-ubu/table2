$(document).ready(function() {
    var ajaxUrl = $('body').data('ajax-url');

    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
            { data: 'id', name: 'id' },
            { 
                data: 'name_product', 
                name: 'name_product',
                render: function(data) {
                    return data.toUpperCase();
                }
            },
            { 
                data: 'description_product', 
                name: 'description_product',
                render: function(data) {
                    return data.length > 50 ? data.substring(0, 50) + '...' : data;
                }
            },
            { 
                data: 'price_product', 
                name: 'price_product',
                render: function(data) {
                    return '$' + parseFloat(data).toFixed(2);
                }
            },
            { 
                data: 'status_product', 
                name: 'status_product',
                render: function(data) {
                    return data === 'Available' ? 'Available' : 'Not Available';
                }
            },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <a href="editData?action=edit&id=${row.id}" class="btn btn-primary">Edit</a>
                        <a href="delete?action=delete&id=${row.id}" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    `;
                }
            }
        ],
        dom: 'Bfrtip', // Ensure buttons are included
        buttons: [
            {
                text: 'Excel',
                extend: 'excelHtml5',
                title: 'Products'
            },
            {
                text: 'XML',
                action: function (e, dt, button, config) {
                    exportToXML(dt);
                }
            },
            {
                text: 'TXT',
                action: function (e, dt, button, config) {
                    exportToTXT(dt);
                }
            }
        ]
    });

    function exportToXML(dt) {
        let data = dt.rows({ search: 'applied' }).data().toArray();
        let xml = '<products>';
        data.forEach(item => {
            xml += `<product>
                        <id>${item.id}</id>
                        <name>${item.name_product}</name>
                        <description>${item.description_product}</description>
                        <price>${item.price_product}</price>
                        <status>${item.status_product}</status>
                    </product>`;
        });
        xml += '</products>';
        
        // Trigger download
        let blob = new Blob([xml], { type: 'text/xml' });
        let url = URL.createObjectURL(blob);
        let a = document.createElement('a');
        a.href = url;
        a.download = 'products.xml';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
    function exportToTXT(dt) {
        let data = dt.rows({ search: 'applied' }).data().toArray();
        let txt = 'ID\tName\tDescription\tPrice\tStatus\n';
        data.forEach(item => {
            txt += `${item.id}\t${item.name_product}\t${item.description_product}\t${item.price_product}\t${item.status_product}\n`;
        });
        
        // Trigger download
        let blob = new Blob([txt], { type: 'text/plain' });
        let url = URL.createObjectURL(blob);
        let a = document.createElement('a');
        a.href = url;
        a.download = 'products.txt';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
  
    // Get the success message from the body data attribute
    var successMessage = message;
    if (successMessage) {
        Swal.fire({
            title: "Done!",
            text: successMessage,
            icon: "success"
        });
    }
});