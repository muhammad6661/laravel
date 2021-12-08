function ajaxReq(r, e = "GET", a, o = null, t = null, n = "null") {
    $.ajaxSetup({
        headers: { "X-CSRF-Token": $("meta[name=csrf-token]").attr("content") },
    }),
        $.ajax({
            url: r,
            data: o,
            type: e,
            contentType: !1,
            cache: !1,
            processData: !1,
            beforeSend: function () {
                null != t && t();
            },
            success: function (r) {
                a(r);
            },
            error: function (r) {
                if ((console.log(r), "null" === n)) console.log(r);
                else if ("window.alert" === n) {
                    let e;
                    $.each(r.responseJSON.errors, function (r, a) {
                        e += a[0];
                    }),
                        alert(e);
                } else
                    $("#" + n).removeClass("d-none"),
                        $.each(r.responseJSON.errors, function (r, e) {
                            $("#" + n).append(e[0] + "<br>");
                        });
            },
        });
}
function getArrayForm(r) {
    return (
        (form_data = {}),
        r.forEach((r) => {
            form_data[r.name] = r.value;
        }),
        form_data
    );
}
function getArrayFormData(r) {
    return (
        (form_data = new FormData()),
        r.forEach((r) => {
            form_data.append(r.name, r.value);
        }),
        form_data
    );
}
function printError(r) {
    return (
        ' <div class="alert alert-icon alert-danger alert-dismissible in" role="alert" style=""><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span></button> <i class="fa fa-exclamation-triangle" style="margin-right:10px;"></i>' +
        r +
        "</div>"
    );
}
var preloader = (preloader =
    '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only">Loading...</span></div>');
$(document).on("click", "#change_checkbox", function (r) {
    r.preventDefault(),
        (clas = $(this).attr("data-class")),
        (id = $(this).attr("data-id")),
        (route = "/admin/" + clas + "/" + id + "/active"),
        console.log(route),
        ajaxReq(route, "Get", (r) => {
            0 == r ? ($(this).prop("checked", !1),
                  $("#active_" + clas + "_" + id + " .text").html("Нет"))
                : 1 == r &&
                  ($(this).prop("checked", !0),
                  $("#active_" + clas + "_" + id + " .text").html("Да"));
        });
}),
    $(document).on("click", "#add_shareholder", function () {
        let r = new FormData();
        (section = $(this).attr("data-type")),
            r.append("section", section),
            ajaxReq(
                "/organization/call/addForm/sharholder",
                "Post",
                (r) => {
                    $("#modal_form .modal-content").html(r),
                        $("#modal_form").modal("show");
                },
                r
            );
    });
var Shareholders = [];
function add_shareholder(r, e, a = null) {
    return `<div class="row justify-content-center" id="form_${e}">\n    <div class="col-sm-6">\n        <div class="form-group">\n            <button\n            onclick="editShareholder(${e},'${a}')" class="form-control btn btn-primary mr-2 waves-effect waves-light">${r}</button>\n        </div>\n    </div>\n    <div style="margin-top:10px;">\n        <a onclick="editShareholder(${e},'${a})'" data-id="${e}"\n            href="javascript:void(0)" class="editableIcons mr-3"><i\n                class=" fas fa-pencil-alt" style="font-size: 16px;"></i></a>\n        <a onclick="deleteShareholder(${e},'${a}')" href="javascript:void(0)"\n            class="editableIcons" "><i\n                class=" fas fa-trash" style="font-size: 16px;"></i></a>\n    </div>\n</div>`;
}
function editShareholder(r, e = null) {
    let a = new FormData();
    "" == e ? a.append("", Shareholders[r]) : a.append("section", "db"),
        a.append("id", r),
        ajaxReq(
            "/organization/call/editForm/sharholder",
            "post",
            (r) => {
                $("#modal_form .modal-content").html(r),
                    $("#modal_form").modal("show");
            },
            a
        );
}
function deleteShareholder(r, e = null) {
    "" == e
        ? (Shareholders[r] = null)
        : ajaxReq("/admin/shareholder/" + r + "/destroy", "Get", (r) => {}),
        $("#form_shareholders #form_" + r).remove(),
        $.jnoty("Успешно удалено!", { sticky: !0, theme: "jnoty-success" }),
        $(".pager #update_form>a").html("Сохранить");
}
$(document).on("click", "#save_shareholder", function () {
    $(this).html(preloader);
    let r = new FormData();
    (form = $("#form_shareholder").serializeArray()),
        (formArray = getArrayForm(form)),
        (r = getArrayFormData(form)),
        (section = $(this).attr("data-type")),
        "db" == section
            ? ((href = window.location.pathname),
              (route =
                  "/admin/organization/" +
                  href.split("/")[4] +
                  "/store/shareholder"))
            : (route = "/validator/shareholder"),
        ajaxReq(
            route,
            "Post",
            (r) => {
                1 == r.err &&
                    ($("#form_shareholder #errors").html(printError(r.msg)),
                    $(this).html("Добавить")),
                    0 == r.err &&
                        ("db" != section
                            ? (Shareholders.push(formArray),
                              $("#form_shareholders").append(
                                  add_shareholder(
                                      formArray.fio_ru,
                                      Shareholders.length
                                  )
                              ))
                            : $("#form_shareholders").append(
                                  add_shareholder(r.title, r.id, "db")
                              ),
                        $("#modal_form").modal("hide"),
                        $.jnoty("Успешно добавлено!", {
                            sticky: !0,
                            theme: "jnoty-success",
                        }),
                        $(".pager #update_form>a").html("Добавить"));
            },
            r
        );
}),
    $(document).on("click", "#update_shareholder", function () {
        $(this).html(preloader), (id = $(this).attr("data-id"));
        let r = new FormData();
        (form = $("#form_shareholder").serializeArray()),
            (route = "/validator/shareholder"),
            "db" == $(this).attr("data-type") &&
                (route = "/admin/shareholder/" + id + "/update"),
            (formArray = getArrayForm(form)),
            (r = getArrayFormData(form)),
            ajaxReq(
                route,
                "Post",
                (r) => {
                    1 == r.err &&
                        ($("#form_shareholder #errors").html(printError(r.msg)),
                        $(this).html("Сохранить")),
                        0 == r.err &&
                            ("db" != $(this).attr("data-type") &&
                                (Shareholders[0] = formArray),
                            $(
                                "#form_shareholders #form_" +
                                    id +
                                    " .waves-light"
                            ).html($("#form_shareholder #fio_ru").val()),
                            console.log(
                                $(
                                    "#form_shareholders #form_" +
                                        id +
                                        " .waves-light"
                                ).html(),
                                $("#form_shareholder #fio_ru").val()
                            ),
                            $("#modal_form").modal("hide"),
                            $.jnoty("Успешно сохранено!", {
                                sticky: !0,
                                theme: "jnoty-success",
                            }),
                            $(".pager #update_form>a").html("Сохранить"));
                },
                r
            );
    }),
    $(document).on("click", ".pager #save_form", function () {
        $(".pager #save_form>a").html(preloader);
        let r = new FormData();
        (form = $("#form_organization").serializeArray()),
            (r = getArrayFormData(form)).append(
                "shareholders",
                JSON.stringify(Shareholders)
            ),
            ajaxReq(
                "/admin/organization/store",
                "Post",
                (r) => {
                    1 == r.err &&
                        ($(".pager #save_form>a").html("Сохранить"),
                        $("#form_organization #errors").html(printError(r.msg)),
                        $('a[href="#basic-info"]').click(),
                        window.scrollTo({top: 150, left: 100,behavior: 'smooth',})),
                        0 == r.err &&
                            (window.location = "/admin/organizations");
                },
                r
            );
    }),
    $(document).on("click", "#update_form", function () {
        $(".pager #update_form>a").html(preloader);
        let r = new FormData();
        (form = $("#form_organization").serializeArray()),
            (r = getArrayFormData(form)),
            ajaxReq(
                "/admin/organization/update/" + $(this).attr("data-id"),
                "Post",
                (r) => {
                    1 == r.err &&
                        ($(".pager #update_form>a").html("Сохранить"),
                        $("#form_organization #errors").html(
                            printError(r.msg)
                        ),
                        window.scrollTo({top: 150, left: 100,behavior: 'smooth',})),
                        0 == r.err &&
                            ($.jnoty("Успешно сохранено!", {
                                sticky: !0,
                                theme: "jnoty-success",
                            }),
                            $(".pager #update_form>a").html("Сохранить"));
                },
                r
            );
    }),
    $(document).on("change", "#filter_category", function () {
        ajaxReq(
            "/admin/shareholder/filter/category/" + $(this).val(),
            "Get",
            (r) => {
                location.reload();
            }
        );
    }),
    $(document).on("change", "#filter_ministry", function () {
        console.log($(this).val()),
            ajaxReq(
                "/admin/shareholder/filter/ministry/" + $(this).val(),
                "Get",
                (r) => {
                    location.reload();
                }
            );
    });
