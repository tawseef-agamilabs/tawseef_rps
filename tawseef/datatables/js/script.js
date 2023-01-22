var xmlhttp = new XMLHttpRequest();

var url = "http://localhost/edubd/rps/tawseef/datatables/js/jsonData.json";

xmlhttp.open("GET", url, true);

xmlhttp.send();



xmlhttp.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);

        // console.log(data);

        // $('#myTable').DataTable({
        //     //ajax: url,
        //     "data": data.data,
        //     columns: [
        // { data: 'name' },
        // { data: 'position' },
        // { data: 'office' },
        // { data: 'extn' },
        // { data: 'start_date' },
        // { data: 'salary' },
        //     ], dom: 'Bfrtip',
        //     buttons: [
        //         'copy', 'csv', 'excel', 'pdf', 'print'
        //     ]
        // });


        // var i = 1;

        // $("#myTable1").dataTable().fnDestroy();


        // $('#myTable1').DataTable({

        //     ajax: base_url + 'specific_function',
        //     "data": data.data,

        //     columns: [

        //         {
        //             "render": function (data, type, full, meta) {
        //                 return i++;
        //             }
        //         },
        //         { data: 'name' },
        //         { data: 'position' },
        //         { data: 'office' },
        //         { data: 'extn' },
        //         { data: 'start_date' },
        //         { data: 'salary' },
        //         {
        //             "render": function (data, type, full, meta) {
        //                 return '<button class="btn btn-success btn-sm" onclick="editBUT(' + full.id + ')">EDIT</button>';
        //             }
        //         }
        //     ]
        // });


        // $('#myTable').DataTable({
        //     "createdRow": function (row, data, dataIndex) {
        //         // Add the edit and delete buttons
        //         $(row).append('<td><button class="edit-button" data-id="' + data[0] + '">Edit</button><button class="delete-button" data-id="' + data[0] + '">Delete</button></td>');
        //     },
        //     "columnDefs": [
        //         {
        //             "targets": -1,  // The last column
        //             "searchable": false,
        //             "orderable": false
        //         }
        //     ]
        // });




        var i = 1;
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "data": data.data,
            "columns": [
                {
                    "data": null,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'name' },
                { data: 'position' },
                { data: 'office' },
                { data: 'extn' },
                { data: 'start_date' },
                { data: 'salary' },
                {
                    "data": null,
                    "render": function (data, type, row, meta) {
                        console.log({ data, type, row, meta });

                        return `<div>
                            <button class="edit-button" data-id="${data[0]}">Edit</button>
                            <button class="delete-button" data-id="${data[0]}">Delete</button>
                        </div>`;
                        // return '<button class="edit-button" data-id="' + data[0] + '">Edit</button><button class="delete-button" data-id="' + data[0] + '">Delete</button>';
                    }
                }




            ]
        });






    }

    $(document).on('click', '.edit-button', function () {
        // Get the data for the row to be edited
        var row = $(this).closest('tr');
        var data = row.data();  // Get the data for the row

        // Show the edit form and populate it with the data


        // get the data from the nearest row
        var name = $(this).closest("tr").find(".name").text(); // data.name;
        var position = $(this).closest("tr").find(".position").text(); // data.position;
        var office = $(this).closest("tr").find(".office").text(); // data.office;
        var extn = $(this).closest("tr").find(".extn").text(); // data.extn;
        var start_date = $(this).closest("tr").find(".start_date").text(); // data.start_date;
        var salary = $(this).closest("tr").find(".salary").text(); // data.salary;

        // show the modal and populate the fields
        ("#myModal").modal("show");
        $("#myModal .modal-body #name").val(name);
        $("#myModal .modal-body #email").val(position);
        $("#myModal .modal-body #phone").val(office);
        $("#myModal .modal-body #phone").val(extn);
        $("#myModal .modal-body #phone").val(start_date);
        $("#myModal .modal-body #phone").val(salary);
    });





}



