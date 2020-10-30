"use strict";

(function ($) {




    $(".js-example-basic-single").select2({
        placeholder: "انتخاب کنید",
    });

    $(window).on("load", function () {
        if (
            $("body").hasClass("horizontal-side-menu") &&
            $(window).width() > 768
        ) {
            if ($("body").hasClass("layout-container")) {
                $(".side-menu .side-menu-body").wrap(
                    '<div class="container"></div>'
                );
            } else {
                $(".side-menu .side-menu-body").wrap(
                    '<div class="container-fluid"></div>'
                );
            }
            setTimeout(function () {
                $(".side-menu .side-menu-body > ul").append(
                    '<li><a href="#"><span>سایر</span></a><ul></ul></li>'
                );
            }, 100);
            $(".side-menu .side-menu-body > ul > li").each(function () {
                var index = $(this).index(),
                    $this = $(this);
                if (index > 7) {
                    setTimeout(function () {
                        $(
                            ".side-menu .side-menu-body > ul > li:last-child > ul"
                        ).append($this.clone());
                        $this.addClass("d-none");
                    }, 100);
                }
            });
        }
    });

    $(document).on("click", '[data-attr="layout-builder-toggle"]', function () {
        $(".layout-builder").toggleClass("show");
        return false;
    });

    $.validator.addMethod(
        "filesize",
        function (value, element, param) {
            return this.optional(element) || element.files[0].size <= param;
        },
        "سایز تصویر نمی تواند بیشتر از یک مگابایت باشد"
    );
    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            return this.optional(element) || regexp.test(value);
        },
        "Please check your input."
    );

    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            return this.optional(element) || regexp.test(value);
        },
        "Please check your input."
    );
    $("#loginForm").validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
                regex: /^[a-zA-Z]+[a-zA-Z\d]*$/,
            },
            mobile: {
                required: true,
                regex: /^09[0-9]{9}$/,
            },
        },
        messages: {
            password: {
                required: "لطفا رمز عبور خود را وارد نمایید",
                minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
                regex: "پسورد نمیتواند با عدد شروع شود",
            },
            mobile: {
                required: "لطفا شماره موبایل خود را وارد نمایید",
                regex: "موبایل دارای فرمت نامعتبر می باشد",
            },
        },
    });
      $("#add-member").validate({
          rules: {
              email: {
                  required: true,
                  email: true
              },

              password: {
                  required: true,
                  minlength: 8
              },
              cpassword: {
                  required: true,
                  equalTo: "#password"
              },
              mobile: {
                  regex: /^09[0-9]{9}$/
              }
          }
      });
    $("#add-plan").validate({
        rules: {
            name: {
                required: true,
                maxlength: 30,
            },
            time: {
                required: true,
            },
            price: {
                required: true,
            },
        },
        messages: {
            name: "لطفا عنوان فایل را وارد نمایید",
            time: "لطفا تعداد روزهای فعال بودن اشتراک را وارد نمایید",
            price: "لطفا قیمت اشتراک را وارد نمایید",
        },
    });
    $("#add-blog").validate({
        rules: {
            name: {
                required: true,
            },
            link_url: {
                regex: /^https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,}$/,
            },

            desc: {
                required: true,
            },
        },
        messages: {
            name: "لطفا عنوان وبلاگ را وارد نمایید",
            link_url: { regex: "لینک وارد شده صحیح نمیباشد" },
            desc: "لطفا توصیح برای بلاگ وارد نمایید",

        },
    });

    $(".add-actor").validate({
        rules: {
            fullname: {
                required: true,
            },
        },
        messages: {
            fullname: "لطفا عنوان فایل را وارد نمایید",
        },
    });

    $(".add-discount").validate({
        rules: {
            title: {
                required: true,
            },
            percent: {
                required: true,
            },
            code: {
                required: true,
            },
            date: {
                required: true,
            },
        },
        messages: {
            title: "لطفا عنوان را وارد نمایید",
            percent: "لطفا درصد تخفیف را وارد نمایید",
            code: "لطفا کد تخفیف را وارد نمایید",
            date: "لطفا  تاریخ را وارد نمایید",
        },
    });



    $("#sendsms").validate({
        rules: {
            for: { required: true },
            title: "required",
            content: "required",
        },
        messages: {
            for: {
                required: "لطفا دریافت کننده را انتخاب کنید",
            },
            title: "لطفا عنوان پیام را وارد نمایید",
            content: "لطفا متن پیام را وارد نمایید",
        },
    });

    $("#upload-section").validate({
        rules: {
            title: {
                required: true,
            },
            serie: "required",
            season: "required",
            number: "required",
            release: "required",
            poster: {
                filesize: 200 * 1024,
                accept: "jpg|jpeg|png|JPG|JPEG|PNG",
            },

            desc: "required",

            "file[1][1]": {
                required: true,
                regex: /^https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,}$/,
            },
        },
        messages: {
            title: {
                required: "لطفا عنوان فایل را وارد نمایید",
                maxlength: "تعداد کاراکترها بیش از حد مجاز میباشد",
            },
            serie: "سریال را انتخاب نمایید",
            season: "فصل را انتخاب کنید",
            number: "شماره قسمت را وارد نمایید",
            desc: "توضیحات برای فایل الزامی است",
            release: "تاریخ پخش را انتخاب کنید",

            file: {
                required: true,

            },
        },
    });


    $("#upload-music").validate({
        rules: {
            title: {
                required: true,
            },
            name: {
                required: true,
            },

            poster: {

                filesize: 2000 * 1024,
                accept: "jpg|jpeg|png|JPG|JPEG|PNG",
            },
            file: {


                accept: "mp3,mp4",
            },
            desc: "required",
            "categories[]": "required",

        },
     
    });

    $('#upload-music').ajaxForm({
        beforeSerialize: function ($Form, options) { },
        beforeSend: function () {
            $('#success').empty();

        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('.btn--wrapper').html(`<button class="btn btn-success" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm m-l-5 fs-0-8" role="status" aria-hidden="true"></span>
                    loading ... 
                </button>`)

            $('.progress-bar').text(percentComplete + '%');
            $('.progress-bar').css('width', percentComplete + '%');


        },
        success: function (data) {
            $(".btn--wrapper").html(
                `<input type="submit" name="upload" id="upload" value="Upload" class="btn  btn-success" />`
            );

            if (data.errors) {
                swal("خطا"
                    , data.errors
                    ,
                    "error", {
                    button: "OK"
                });
            }
            if (data.success) {

                swal("Success"
                    , "Insert Data Successfully"
                    ,
                    "success", {
                    button: "OK"
                });
            }
            $('.progress-bar').text('Complete');
            $('.progress-bar').css('width', '0%');
            setTimeout(() => {
                location.reload();
            }, 1000);

        },

        error: function (data) {

            swal("خطا"
                , data.responseJSON.errors
                ,
                "error", {
                button: "OK"
            });
            $(".btn--wrapper").html(
                `<input type="submit" name="upload" id="upload" value="Upload" class="btn  btn-success" />`
            );
            $('.progress-bar').css('width', '0%');

        }
    });



    $("#upload").click(function () {
        if ($("#upload-file").valid()) {
            $(this).val("در حال آپلود ...");
        }
    });
})(jQuery);

function getClone(element) {
    element = $(element);
    let next = element.next(".row");

    next.append(`<div class=" col-md-3 image-box">
                        <div class="form-group">
                               <input type="file" name="images[]" class="dropify" data-default-file="" />
                    </div>
                   </div>`);
    $(".dropify").dropify(dropifyOptions);
}

function addFile(event, el) {
    event.preventDefault();
    let id = Math.random();
    var token = $('meta[name="_token"]').attr("content");
    let close =
        '<span style="left: 18px;position: absolute;color: red;z-index:5;padding:5px;cursor:pointer" onclick="remove(this)" ><i class="fa fa-times"></i></span>';
    $(el).prev().append(`
    <form class="video" action="#" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="${token}">
                <div class="files-wrapper">
      <div class="row position-relative">${close}
      
                                        <div class="form-group col-md-6">
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <label for=""> فایل: </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="file" name="file" id="file" class="dropify"
                                                        data-default-file="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="custom-control custom-checkbox custom-control">
                                                <input type="checkbox" id="${id}" name="quality[]" value="hd"
                                                    class="custom-control-input">
                                                <label class="custom-control-label" for="${id}">کیفیت بالا</label>
                                            </div>
                                            <div class="custom-control custom-checkbox custom-control">
                                                <input type="checkbox" id="${
        id + 1
        }" name="quality[]" value="md"
                                                    class="custom-control-input">
                                                <label class="custom-control-label" for="${
        id + 1
        }">کیفیت متوسط</label>
                                            </div>
                                            <div class="custom-control custom-checkbox custom-control">
                                                <input type="checkbox" id="${
        id + 2
        }" name="quality[]" value="sd"
                                                    class="custom-control-input">
                                                <label class="custom-control-label" for="${
        id + 2
        }">کیفیت پایین</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                           <button class="btn btn-sm btn-primary text-white" type="submit" >آپلود</button>
                                            <div class="progress mt-3">
                                                <div class="progress-bar" role="progressbar" aria-valuenow=""
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                    0%
                                                </div>
                                            </div>
                                        </div>

                                    </div></div></form>`);
    $(".dropify").dropify(dropifyOptions);
}

function addCategory(event, url) {
    event.preventDefault();
    var el = $(event.target);

    let name = $(event.target).prev().find("#category").val();
    var token = $('meta[name="_token"]').attr("content");
    // data = ;

    var request = $.post(url, { name: name, _token: token });
    request.done(function (res) {

        if (name !== "") {
            let id = Math.random();
            let wrapper = $(".cat-wrapper");
            wrapper.prepend(`
         <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="${id}" name="category"
                                  value="${name}"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="${id}">${name}</label>
                            </div>
         `);
        }
    })
}

function addTag(event) {
    event.preventDefault();
    let val = $(event.target).prev().find('#tag').val();
    if (val !== "") {
        let id = Math.random();
        let wrapper = $('.tag-wrapper');
        wrapper.append(`
         <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" id="tag-${id}" name="tags[]"
                                 value="${val}"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="tag-${id}">${val}</label>
                            </div>
         `);
    }
}

function addLyric(event) {
    event.preventDefault();
    let val = $(event.target).prev().find('#lyric').val();
    if (val !== "") {
        let id = Math.random();
        let wrapper = $('.lyric-wrapper');
        wrapper.append(`
         <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" id="lyric-${id}" name="lyrics[]"
                                 value="${val}"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="lyric-${id}">${val}</label>
                            </div>
         `);
    }
}

function addAlbum(event) {
    event.preventDefault();
    let val = $(event.target).prev().find("#album").val();
    if (val !== "") {
        let id = Math.random();
        let wrapper = $(".album-wrapper");
        wrapper.append(`
         <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" id="album-${id}" name="albums[]"
                                 value="${val}"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="album-${id}">${val}</label>
                            </div>
         `);
    }
}


function addArrangement(event) {
    event.preventDefault();
    let val = $(event.target).prev().find("#arrangement").val();
    if (val !== "") {
        let id = Math.random();
        let wrapper = $(".arrangement-wrapper");
        wrapper.append(`
         <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" id="arrangement-${id}" name="arrangements[]"
                                 value="${val}"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="arrangement-${id}">${val}</label>
                            </div>
         `);
    }
}



function addToInput(event) {
    event.preventDefault();
    let text = $(event.target).text();
    $(event.target).parent().parent().prev().val(text);
    $(event.target).parent().parent().hide();
}

function addPlayList(event) {
    event.preventDefault();
    let val = $(event.target).prev().find("#playlist").val();
    if (val !== "") {
        let id = Math.random();
        let wrapper = $(".playlist-wrapper");
        wrapper.append(`
         <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" id="playlist-${id}" name="playlists[]"
                                 value="${val}"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="playlist-${id}">${val}</label>
                            </div>
         `);
    }
}

$("#poster").change(function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#preview").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    }
});

function removeCaption(event) {
    event.preventDefault();
    $(event.target).parents(".caption-item").remove();
    return true;
}

function removeBlogLink(event) {
    event.preventDefault();
    $(event.target).parents(".link-item").remove();
    return true;
}

function addCaption(event) {
    event.preventDefault();
    var preve = $(event.target).prev();
    var id = Math.random();
    preve.after(`  <div class="col-md-12 row caption-item">
                            <a class="text-danger" style="position:absolute;left:0;" onclick="removeCaption(event)"><i class="fas fa-times" ></i></a>
                                <label for="" class="col-md-2">زیرنویس</label>
                                <div class="col-md-3 ">
                                   <input type="text" class="form-control" name="captions[${id}][1]">
                                </div>
                                <div class="col-md-3">
                                   <input type="file" name="captions[${id}][2]" id="" class="form-control" />
                                </div>
                            </div>
       `);
}


function addBlogLink(event) {
    event.preventDefault();


    $(event.target).prev().after(` 
     <div class="row link-item">
      <a class="text-danger" style="position:absolute;left:0;" onclick="removeBlogLink(event)"><i class="fas fa-times" ></i></a>
    <div class="col-md-6  mt-3">
            <input required type="text" class="form-control" name="link_name[]" id="link_name" value=""
                                    placeholder="نام منبع">
         </div>
         <div class="col-md-6 mt-3">
             <input  type="text" class="form-control" name="link_url[]" id="link_url" value=""
                                    placeholder="آدرس">
         </div></div>
       `);
}
function remove(event) {
    event.preventDefault();
    $(event.target).parents(".cloned").remove();
    return true;
}

$(document).on("click", ".delete-file", remove);

function removeFile(event) {
    event.preventDefault();
    $(event.target).parents(".upload-season-file").remove();
    return true;
}



function cloneFile(event) {
    event.preventDefault();
    var id = Math.random();
    var preve = $(event.target).parents(".clone").prev(".upload-season-file");
    console.log(preve);
    preve.after(`
      <div class="row upload-season-file mx-2 mb-2 pb-2">
        <a class="text-danger" style="position:absolute;left:30px;padding:5px;z-index:10;cursor:pointer;" onclick="removeFile(event)"><i class="fas fa-times" ></i></a>
                            <div class="form-group col-md-9">

                                <label for=""> فایل: </label>

                                <input required type="file" name="file[${id}][1]" id="" class="form-control" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for=""> کیفیت: </label>
                                <select name="file[${id}][2]" id="" class=" custom-select  ">
                                    <option value="360">360</option>
                                    <option value="480">480</option>
                                    <option value="576">576</option>
                                    <option value="720">720</option>
                                    <option value="1028">1028</option>

                                </select>
                            </div>

                          
                            </div>
                            <a href="#" onclick="addCaption(event)">افزودن زیرنویس </a>
                        </div>          
     `);

    return true;
}

function showCaptionFile(event) {
    if ($(event.target).is(":checked")) {
        $(event.target).parent().parent().append(`
        
                           <div class="col-md-12 d-flex caption-wrapper" >
                                <div class="col-md-8" >
                                <input type="file" name="caption_file[]" class="form-control m-3">
                            </div>
                            <div class="col-md-4 mt-3">
                                <select name="caption_lang[]" id="" class="custom-select">
                                    <option value="">انگلیسی</option>
                                    <option value="">دوبله فارسی</option>
                                    <option value="">زیرنویس فارسی</option>
                                    <option value="">زیرنویس انگلیسی</option>
                                </select>
                            </div>
                           </div>`);
    } else {
        $(event.target).parent().parent().find(".caption-wrapper").remove();
    }
}

var dropifyOptions = {
    messages: {
        default:
            "فایل خود را کشیده و اینجا رها کنید یا برای انتخاب فایل کلیک کنید",
        replace:
            "فایل خود را کشیده و اینجا رها کنید یا برای تغییر فایل کلیک کنید",
        remove: "حذف",
        error: "اوپس،خطایی رخ داده است",
    },
    error: {
        fileSize: "فایل انتخابی شما بزرگتر از محدودیت حجم تعیین شده است",
        imageFormat: "تصویر دارای فرمت نامعتبر میباشد",
    },
};
$(".dropify").dropify(dropifyOptions);




function deleteCategory(event, id, url) {
    event.preventDefault()
    var token = $('meta[name="_token"]').attr("content");

    var request = $.post(url, { id: id, _token: token });
    request.done(function (res) {
        $(event.target).parents('.custom-control').remove()
    });

}


function deleteAlbum(event, id, url) {
    event.preventDefault();
    var token = $('meta[name="_token"]').attr("content");

    var request = $.post(url, { id: id, _token: token });
    request.done(function (res) {
        $(event.target).parents(".custom-control").remove();
    });
}


function deleteTag(event, id, url) {
    event.preventDefault();
    var token = $('meta[name="_token"]').attr("content");

    var request = $.post(url, { id: id, _token: token });
    request.done(function (res) {
        $(event.target).parents(".custom-control").remove();
    });
}

function deleteLyric(event, id, url) {
    event.preventDefault();
    var token = $('meta[name="_token"]').attr("content");

    var request = $.post(url, { id: id, _token: token });
    request.done(function (res) {
        $(event.target).parents(".custom-control").remove();
    });
}

function deleteArrangement(event, id, url) {
    event.preventDefault();
    var token = $('meta[name="_token"]').attr("content");

    var request = $.post(url, { id: id, _token: token });
    request.done(function (res) {
        $(event.target).parents(".custom-control").remove();
    });
}

function deleteCaption(event, id, url) {
    event.preventDefault();
    var token = $('meta[name="_token"]').attr("content");
    var request = $.post(url, { id: id, _token: token });
    request.done(function (res) {
        $(event.target).parents(".cap-wrapper").remove();
    });
}

function deleteFile(event, id, url) {
    event.preventDefault();
    var token = $('meta[name="_token"]').attr("content");
    var request = $.post(url, { id: id, _token: token });
    request.done(function (res) {
        $(event.target).parents(".file-wrapper").remove();
    });
}

function changeFeaturedPlaylist(event, id , url) {
     event.preventDefault();
     var token = $('meta[name="_token"]').attr("content");
     var request = $.post(url, { id: id, _token: token });
     request.done(function(res) {
        if(res.data == 1) {
            $(event.target).removeClass('btn-danger')
            $(event.target).addClass('btn-success')
        }else{
            $(event.target).removeClass("btn-success");
            $(event.target).addClass("btn-danger");
        }
     });
}