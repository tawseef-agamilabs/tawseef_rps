<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />

    <title>Mark entry</title>
    <style>
        .ecf {
            color: grey;
            text-align: center;
        }

        .exam_course_filter_form {
            text-align: center;
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <h1 class="ecf">Exam Course filter</h1>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <form class="exam_course_filter_form" id="exam_course_filter_form">
                        <label>
                            Course Level

                            <div class="input-group mb-3 p-3">
                                <select id="course_select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">

                                </select>
                            </div>

                        </label>

                        <label>
                            group
                            <div class="input-group mb-3 p-3">
                                <select id="group_select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">


                                </select>
                            </div>

                        </label>

                        <label>
                            Academic Year
                            <div class="input-group mb-3 p-3">
                                <input type="text" class="form-control" id="academic_year" placeholder="2022" aria-describedby="">
                            </div>

                        </label>

                        <div class="p-2">
                            <input style="width: 15%;" type="submit" value="Submit" id="ecf_bu" class="btn btn-primary text-center ">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </section>

    <h2 style="margin-top: 40px;" class="ecf">Form filter</h2>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <form id="form_filter_form" style="margin-top: 46px;" class="exam_course_filter_form ">
                        <label>
                            exam

                            <div class="input-group mb-3 p-3">
                                <select id="exam_select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">

                                </select>


                            </div>

                        </label>

                        <label>
                            Course
                            <div class="input-group mb-3 p-3">
                                <select id="course_name_select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                </select>
                            </div>

                        </label>

                        <div class="p-2">
                            <input id="teacher_input" style="width: 15%;" type="submit" value="Get Teacher List" class="btn btn-primary text-center">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">

                    <table id="section_teacher_table" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="option1">
                                    </div>
                                </th>
                                <th scope="col">Sections</th>
                                <th scope="col">Teacher</th>
                            </tr>
                        </thead>

                        <tbody id="section_teacher_tbody">

                            <tr>
                                <th scope=" row">
                                    <div class="form-check form-check-inline form-check-row">
                                        <input class="form-check-input" type="checkbox" value="">
                                    </div>
                                </th>
                                <td>

                                    <div class="form-check form-check-inline">
                                        <label for="">
                                            <input class="form-check-input" type="checkbox" value="">
                                            All
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label for="">
                                            <input class="form-check-input" type="checkbox" value="">
                                            A
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <label for="">
                                            <input class="form-check-input" type="checkbox" value="">
                                            none
                                        </label>
                                    </div>
                                </td>
                                <td>munna</td>
                            </tr>


                        </tbody>
                    </table>


                </div>
            </div>
            <div class="p-2 text-center">
                <input id="assignPermissionButton" style="width: 15%;" type="button" value="Assign Permission" class="btn btn-primary text-center assignPermissionButton">
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="./jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            let classSections;

            /// getCourse
            function getCourseLevel() {
                $.ajax({
                    url: "../php/ui/settings/get_all_course_levels.php",
                    method: "POST",
                    dataType: "json",
                    success: function(courseLevelObject) {

                        if (courseLevelObject.error) {
                            toastr.error(courseLevelObject.message);
                            return;
                        }

                        let option = "";
                        for (i = 0; i < courseLevelObject.data.length; i++) {
                            option += "<option value = '" + courseLevelObject.data[i].courselevelno + "' >" + courseLevelObject.data[i].courseleveltitle + "</option>";
                        }
                        $('#course_select').html(option);

                        const date = new Date();
                        $("#academic_year").val(date.getFullYear() - 1);
                    }
                });
            }
            getCourseLevel();

            //// getGroup>
            function getGroupLabel() {
                $.ajax({
                    url: "../php/ui/settings/get_all_groups.php",
                    method: "POST",
                    dataType: "json",
                    success: function(groupObject) {

                        if (groupObject.error) {
                            toastr.error(groupObject.message);
                            return;
                        }

                        // console.log(groupObject);
                        let option = "";
                        for (i = 0; i < groupObject.data.length; i++) {
                            option += "<option value = '" + groupObject.data[i].groupno + "' >" + groupObject.data[i].grouptitle + "</option>";
                        }
                        $('#group_select').html(option);

                    }
                });
            }
            getGroupLabel();

            ///// showing filter form data>> getExam
            $('#exam_course_filter_form').submit(function(e) {
                e.preventDefault();

                let course_select = $('#course_select').val();
                let group_select = $('#group_select').val();
                let academic_year = $('#academic_year').val();

                let dataObject = {
                    academicyear: academic_year,
                    courselevelno: course_select,
                    groupno: group_select
                };
                // console.log(dataObject);

                $.ajax({
                    url: "../php/ui/pre_marks/get_exams.php", //get exam based on 3 param
                    method: "POST",
                    dataType: "json",
                    data: dataObject,
                    success: function(examObject) {

                        if (examObject.error) {
                            toastr.error(examObject.message);
                            return;
                        }
                        console.log(examObject);

                        let option = "";
                        for (i = 0; i < examObject.data.length; i++) {
                            option += "<option value = '" + examObject.data[i].examno + "' >" + examObject.data[i].examtitle + examObject.data[i].courseleveltitle + "</option>";
                        }
                        $('#exam_select').html(option);
                        getExamCourses();

                    }
                });

            });

            function getExamCourses() {
                let examno = $('#exam_select').val();

                let courseNameObject = {
                    examno
                };
                console.log(courseNameObject);

                $.ajax({
                    url: "../php/ui/marksentrypermission/get_all_exam_course.php",
                    method: "POST",
                    dataType: "json",
                    data: courseNameObject,
                    success: function(courseObject) {

                        if (courseObject.error) {
                            toastr.error(courseObject.message);
                            return;
                        }
                        console.log(courseObject);

                        let option = "";
                        for (i = 0; i < courseObject.data.length; i++) {
                            option += "<option value = '" + courseObject.data[i].coursecode +
                                "' >" + courseObject.data[i].coursetitle +
                                "</option>";
                        }
                        $('#course_name_select').html(option);
                    }
                });
            }

            //getCourse auto show
            $('#exam_select').change(function(e) {
                getExamCourses();
            });

            /// getSection
            function getSection() {
                $.ajax({
                    url: "../php/ui/settings/get_all_classsections.php",
                    method: "POST",
                    dataType: "json",
                    success: function(sectionObject) {

                        if (sectionObject.error) {
                            toastr.error(sectionObject.message);
                            return;
                        }

                        classSections = sectionObject.data;

                    }
                });
            }
            getSection();

            function showTeacher(teachers) {
                for (i = 0; i < teachers.length; ++i) {
                    let row = $(
                            `
                        <tr>
                            <th scope=" row">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input row-check" type="checkbox" value="">
                                </div>
                            </th>
                            <td>

                                <div class="form-check form-check-inline">
                                    <label>
                                        <input class="form-check-input section-check" type="checkbox" value="">
                                        none
                                    </label>
                                </div>

                                ${classSections.map(a=>`<div class="form-check form-check-inline">
                                    <label >
                                        <input class="form-check-input section-check" type="checkbox" value="${a.csid}">
                                        ${a.sectionlabel}
                                    </label>
                                </div>`).join("")}

                                <div class="form-check form-check-inline">
                                    <label >
                                        <input class="form-check-input section-check" type="checkbox" value="-1">
                                        All
                                    </label>
                                </div>
                            </td>

                            <td>${teachers[i].fullname}<br>${teachers[i].email}</td>
                        </tr>`

                        ).data(`userno`, teachers[i].userno)
                        .appendTo(`#section_teacher_tbody`);
                }
            }

            $(document).on(`change`, '.section-check', function() {

                let thisRow = $(this).parents('tr'); /// whole row
                let sectionCheckThisRow = thisRow.find('.section-check'); /// all section + none + all
                let rowCheckThisRow = thisRow.find('.row-check'); /// row_left

                if (this.value == "") {
                    ///none checkbox
                    sectionCheckThisRow.not(this).prop(`checked`, false);
                } else if (this.value == "-1") {
                    ///all checkbox
                    sectionCheckThisRow.not(`[value='']`).prop(`checked`, this.checked);
                    thisRow.find(`.section-check[value='']`).prop(`checked`, false);
                } else {
                    let Section = thisRow.find(".section-check").not(`[value='-1']`).not(`[value='']`).length; ///valid section
                    let validCheckedSection = thisRow.find(".section-check:checked").not(`[value='-1']`).not(`[value='']`).length;
                    // console.log(Section);
                    // console.log(validCheckedSection);

                    if (Section == validCheckedSection) {
                        /// every valid sections selected => check all section except none
                        sectionCheckThisRow.not(`[value='']`).prop(`checked`, true);
                    } else { /// any valid section unchecked => uncheck `all`
                        thisRow.find(`.section-check[value='-1']`).prop(`checked`, false);
                    }

                    /// section except none checked => none unchecked
                    thisRow.find(`.section-check[value='']`).prop(`checked`, false);
                }

                rowCheckThisRow.prop(`checked`, thisRow.find(".section-check:checked").length > 0);

            });

            // getTeacher list
            $('#form_filter_form').submit(function(e) {
                e.preventDefault();
                $(`#section_teacher_tbody`).empty();

                let examno = $('#exam_select').val();
                let coursecode = $('#course_name_select').val();

                let dataObject = {
                    examno,
                    coursecode
                };
                //console.log(dataObject);

                $.ajax({
                    url: "../php/ui/selection/get_all_teachers_with_markentrypermission.php",
                    method: "POST",
                    dataType: "json",
                    data: dataObject,
                    success: function(teacherObject) {

                        if (teacherObject.error) {
                            toastr.error(teacherObject.message);
                            return;
                        }

                        showTeacher(teacherObject.data);

                    }
                });

            });

            //// assignPermission>
            function assignPermission(data) {
                $.ajax({ // assignPermissionAjax
                    url: "../php/ui/marksentrypermission/assign_permission.php",
                    method: "POST",
                    dataType: "json",
                    data: data,
                    success: function(permissionObject) {
                        if (permissionObject.error) {
                            toastr.error(permissionObject.message);
                            return;
                        } else {
                            toastr.success(permissionObject.message);
                        }
                    }
                });
            } // function assignPermission()  end

            $('#assignPermissionButton').click(function(e) {
                e.preventDefault();
                let courselevelno = $('#course_select').val();
                let examno = $('#exam_select').val();
                let coursecode = $('#course_name_select').val();
                let teacher = [];

                let dataObject = {
                    courselevelno,
                    examno,
                    coursecode,
                    teacher: []
                };

                $(`#section_teacher_tbody tr:has(.row-check:checked)`).each((eachrow, row) => {
                    let object = {
                        userno: $(row).data(`userno`),
                        sections: $(`.section-check:checked:not([value='-1'])`, row)
                            .toArray()
                            .map(elem => $(elem).val())
                    };

                    dataObject.teacher = [...dataObject.teacher, object];

                });

                // console.log(`json =>`, json);
                dataObject.teacher = JSON.stringify(dataObject.teacher);
                assignPermission(dataObject);
            });

        });
    </script>

</body>

</html>