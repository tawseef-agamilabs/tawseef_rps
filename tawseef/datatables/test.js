$(document).ready(function () {
    editor = new $.fn.dataTable.Editor({
        "ajax": "../php/staff.php",
        "table": "#example",
        "fields": [{
            "label": "First name:",
            "name": "first_name"
        }, {
            "label": "Last name:",
            "name": "last_name"
        }, {
            "label": "Position:",
            "name": "position"
        }, {
            "label": "Office:",
            "name": "office"
        }, {
            "label": "Extension:",
            "name": "extn"
        }, {
            "label": "Start date:",
            "name": "start_date",
            "type": "datetime"
        }, {
            "label": "Salary:",
            "name": "salary"
        }
        ]
    });

    // New record
    // $('a.editor-create').on('click', function (e) {
    //     e.preventDefault();

    //     editor.create({
    //         title: 'Create new record',
    //         buttons: 'Add'
    //     });
    // });

    // Edit record
    $('#myTable').on('click', 'td.editor-edit', function (e) {
        e.preventDefault();

        editor.edit($(this).closest('tr'), {
            title: 'Edit record',
            buttons: 'Update'
        });
    });

    // Delete a record
    $('#myTable').on('click', 'td.editor-delete', function (e) {
        e.preventDefault();

        editor.remove($(this).closest('tr'), {
            title: 'Delete record',
            message: 'Are you sure you wish to remove this record?',
            buttons: 'Delete'
        });
    });

    $('#example').DataTable({
        ajax: "../php/staff.php",
        columns: [
            {
                data: null, render: function (data, type, row) {
                    // Combine the first and last names into a single table field
                    return data.first_name + ' ' + data.last_name;
                }
            },
            { data: "position" },
            { data: "office" },
            { data: "extn" },
            { data: "start_date" },
            { data: "salary", render: $.fn.dataTable.render.number(',', '.', 0, '$') },
            {
                data: null,
                className: "dt-center editor-edit",
                defaultContent: '<i class="fa fa-pencil"/>',
                orderable: false
            },
            {
                data: null,
                className: "dt-center editor-delete",
                defaultContent: '<i class="fa fa-trash"/>',
                orderable: false
            }
        ]
    });
});