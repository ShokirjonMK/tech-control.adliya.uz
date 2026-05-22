/*!
 * bsCustomFileInput v1.3.2 (https://github.com/Johann-S/bs-custom-file-input)
 * Copyright 2018 - 2019 Johann-S <johann.servoire@gmail.com>
 * Licensed under MIT (https://github.com/Johann-S/bs-custom-file-input/blob/master/LICENSE)
 */
! function(e, t) { "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : (e = e || self).bsCustomFileInput = t() }(this, function() {
    "use strict";
    var d = { CUSTOMFILE: '.custom-file input[type="file"]', CUSTOMFILELABEL: ".custom-file-label", FORM: "form", INPUT: "input" },
        r = function(e) {
            if (0 < e.childNodes.length)
                for (var t = [].slice.call(e.childNodes), n = 0; n < t.length; n++) { var r = t[n]; if (3 !== r.nodeType) return r }
            return e
        },
        u = function(e) {
            var t = e.bsCustomFileInput.defaultText,
                n = e.parentNode.querySelector(d.CUSTOMFILELABEL);
            n && (r(n).innerHTML = t)
        },
        n = !!window.File,
        l = function(e) { if (e.hasAttribute("multiple") && n) return [].slice.call(e.files).map(function(e) { return e.name }).join(", "); if (-1 === e.value.indexOf("fakepath")) return e.value; var t = e.value.split("\\"); return t[t.length - 1] };

    function v() {
        var e = this.parentNode.querySelector(d.CUSTOMFILELABEL);
        if (e) {
            var t = r(e),
                n = l(this);
            n.length ? t.innerHTML = n : u(this)
        }
    }

    function p() { for (var e = [].slice.call(this.querySelectorAll(d.INPUT)).filter(function(e) { return !!e.bsCustomFileInput }), t = 0, n = e.length; t < n; t++) u(e[t]) }
    var m = "bsCustomFileInput",
        L = "reset",
        h = "change";
    return {
        init: function(e, t) {
            void 0 === e && (e = d.CUSTOMFILE), void 0 === t && (t = d.FORM);
            for (var n, r, l, i = [].slice.call(document.querySelectorAll(e)), o = [].slice.call(document.querySelectorAll(t)), u = 0, c = i.length; u < c; u++) {
                var f = i[u];
                Object.defineProperty(f, m, { value: { defaultText: (n = f, r = void 0, void 0, r = "", l = n.parentNode.querySelector(d.CUSTOMFILELABEL), l && (r = l.innerHTML), r) }, writable: !0 }), v.call(f), f.addEventListener(h, v)
            }
            for (var a = 0, s = o.length; a < s; a++) o[a].addEventListener(L, p), Object.defineProperty(o[a], m, { value: !0, writable: !0 })
        },
        destroy: function() {
            for (var e = [].slice.call(document.querySelectorAll(d.FORM)).filter(function(e) { return !!e.bsCustomFileInput }), t = [].slice.call(document.querySelectorAll(d.INPUT)).filter(function(e) { return !!e.bsCustomFileInput }), n = 0, r = t.length; n < r; n++) {
                var l = t[n];
                u(l), l[m] = void 0, l.removeEventListener(h, v)
            }
            for (var i = 0, o = e.length; i < o; i++) e[i].removeEventListener(L, p), e[i][m] = void 0
        }
    }
});
//# sourceMappingURL=bs-custom-file-input.min.js.map
$(function() {
    $("#example1").DataTable();
    $('.example2').DataTable({
        "searching": true,

        "paging": true,
        "lengthChange": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
    $('#example3').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
    $('#example6').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});

$(document).ready(function() {
    $("#tableDefaultCheck1").change(function() {

        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

});

$(document).ready(function() {
    $("#tableCheck1").change(function() {

        $(".check1").prop('checked', $(this).prop("checked"));
    });
    $(".check1").change(function() {
        var a = $("input:checkbox");

        if (a.length == a.filter(":checked").length) {
            $('#tableCheck1').prop('checked', true);
        } else {
            $('#tableCheck1').prop('checked', false);
        }
        if (a.length - 1 == a.filter(":checked").length) {
            $('#tableCheck1').prop('checked', true);
        }
    });
});

$(document).ready(function() {
    $("#tableCheck2").change(function() {

        $(".check2").prop('checked', $(this).prop("checked"));
    });
    $(".check2").change(function() {
        var a = $("input:checkbox");

        if (a.length == a.filter(":checked").length) {
            $('#tableCheck2').prop('checked', true);
        } else {
            $('#tableCheck2').prop('checked', false);
        }
        if (a.length - 1 == a.filter(":checked").length) {
            $('#tableCheck2').prop('checked', true);
        }
    });
});

$(document).ready(function() {
    $("#tableCheck3").change(function() {

        $(".check3").prop('checked', $(this).prop("checked"));
    });
    $(".check3").change(function() {
        var a = $("input:checkbox");

        if (a.length == a.filter(":checked").length) {
            $('#tableCheck3').prop('checked', true);
        } else {
            $('#tableCheck3').prop('checked', false);
        }
        if (a.length - 1 == a.filter(":checked").length) {
            $('#tableCheck3').prop('checked', true);
        }
    });
});

$(document).ready(function() {
    $("#tableCheck4").change(function() {

        $(".check4").prop('checked', $(this).prop("checked"));
    });
    $(".check4").change(function() {
        var a = $("input:checkbox");

        if (a.length == a.filter(":checked").length) {
            $('#tableCheck4').prop('checked', true);
        } else {
            $('#tableCheck4').prop('checked', false);
        }
        if (a.length - 1 == a.filter(":checked").length) {
            $('#tableCheck4').prop('checked', true);
        }
    });
});

$(document).ready(function() {
    $("#tableCheck5").change(function() {

        $(".check5").prop('checked', $(this).prop("checked"));
    });
    $(".check5").change(function() {
        var a = $("input:checkbox");

        if (a.length == a.filter(":checked").length) {
            $('#tableCheck5').prop('checked', true);
        } else {
            $('#tableCheck5').prop('checked', false);
        }
        if (a.length - 1 == a.filter(":checked").length) {
            $('#tableCheck5').prop('checked', true);
        }
    });
});

$(document).ready(function() {
    $("#tableCheck6").change(function() {

        $(".check6").prop('checked', $(this).prop("checked"));
    });
    $(".check6").change(function() {
        var a = $("input:checkbox");

        if (a.length == a.filter(":checked").length) {
            $('#tableCheck6').prop('checked', true);
        } else {
            $('#tableCheck6').prop('checked', false);
        }
        if (a.length - 1 == a.filter(":checked").length) {
            $('#tableCheck6').prop('checked', true);
        }
    });
});

$(document).ready(function() {
    $("#tableCheck7").change(function() {

        $(".check7").prop('checked', $(this).prop("checked"));
    });
    $(".check7").change(function() {
        var a = $("input:checkbox");

        if (a.length == a.filter(":checked").length) {
            $('#tableCheck7').prop('checked', true);
        } else {
            $('#tableCheck7').prop('checked', false);
        }
        if (a.length - 1 == a.filter(":checked").length) {
            $('#tableCheck7').prop('checked', true);
        }
    });
});

$(document).ready(function() {
    $(".saveAsExcel").click(function() {
        var workbook = XLSX.utils.book_new();

        //var worksheet_data  =  [['hello','world']];
        //var worksheet = XLSX.utils.aoa_to_sheet(worksheet_data);

        var worksheet_data = document.getElementById("example3");
        var worksheet = XLSX.utils.table_to_sheet(worksheet_data);
        workbook.SheetNames.push("Test");
        workbook.Sheets["Test"] = worksheet;
        exportExcelFile(workbook);
    });
})

function exportExcelFile(workbook) {
    return XLSX.writeFile(workbook, "bookName.xlsx");
}

$('#passwordshower').click(function() {


    var id = $(this).data('idec');

    var _token = $('input[name="_token"]').val();

    $.ajax({

        url: "/backend/uz/user/fetch",

        method: "GET",

        data: {

            id: id,

            _token: _token,

        },

        success: function(result) {

            document.getElementById('passwordshower').style.display = "none";
            document.getElementById('item_v').style.display = "block";

            document.getElementById('item_v').innerHTML = result;

        }

    })

});


$(function() {
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })

})
var CheckboxDropdown = function(el) {
    var _this = this;
    this.isOpen = false;
    this.areAllChecked = false;
    this.$el = $(el);
    this.$label = this.$el.find('.dropdown-label');
    this.$checkAll = this.$el.find('[data-toggle="check-all"]').first();
    this.$inputs = this.$el.find('[type="checkbox"]');

    this.onCheckBox();

    this.$label.on('click', function(e) {
        e.preventDefault();
        _this.toggleOpen();
    });

    this.$checkAll.on('click', function(e) {
        e.preventDefault();
        _this.onCheckAll();
    });

    this.$inputs.on('change', function(e) {
        _this.onCheckBox();
    });
};

CheckboxDropdown.prototype.onCheckBox = function() {
    this.updateStatus();
};

CheckboxDropdown.prototype.updateStatus = function() {
    var checked = this.$el.find(':checked');

    this.areAllChecked = false;
    this.$checkAll.html('Check All');

    if (checked.length <= 0) {
        this.$label.html('Select Options');
    } else if (checked.length === 1) {
        this.$label.html(checked.parent('label').text());
    } else if (checked.length === this.$inputs.length) {
        this.$label.html('All Selected');
        this.areAllChecked = true;
        this.$checkAll.html('Uncheck All');
    } else {
        this.$label.html(checked.length + ' Selected');
    }
};

CheckboxDropdown.prototype.onCheckAll = function(checkAll) {
    if (!this.areAllChecked || checkAll) {
        this.areAllChecked = true;
        this.$checkAll.html('Uncheck All');
        this.$inputs.prop('checked', true);
    } else {
        this.areAllChecked = false;
        this.$checkAll.html('Check All');
        this.$inputs.prop('checked', false);
    }

    this.updateStatus();
};

CheckboxDropdown.prototype.toggleOpen = function(forceOpen) {
    var _this = this;

    if (!this.isOpen || forceOpen) {
        this.isOpen = true;
        this.$el.addClass('on');
        $(document).on('click', function(e) {
            if (!$(e.target).closest('[data-control]').length) {
                _this.toggleOpen();
            }
        });
    } else {
        this.isOpen = false;
        this.$el.removeClass('on');
        $(document).off('click');
    }
};

var checkboxesDropdowns = document.querySelectorAll('[data-control="checkbox-dropdown"]');
for (var i = 0, length = checkboxesDropdowns.length; i < length; i++) {
    new CheckboxDropdown(checkboxesDropdowns[i]);
}
$('#faculty').change(function() {
    if ($(this).val() != '') {
        var faculty_id = $(this).val();
        var url = '../../../backend/exam-permission/ajaxdirection/';
        $.ajax({
            url: url,
            method: "GET",
            data: { faculty_id: faculty_id },
            success: function(result) {
                var direction = (result.direction);
                var groups = (result.groups);
                var fanlar = (result.fanlar);

                var html = '<option value="0" style="display:none">Yo`nalishni tanlang</option>';
                var html4 = '<option value="" required style="display:none">-Fanni tanlang-</option>';
                var html2 = '';
                var html3 = '';

                $.each(direction, function(key, value) {
                    html = html + '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                });

                $.each(groups, function(key, value) {
                    html2 = html2 + '<label style="padding: 0 10px 0 0;"><input checked type="checkbox" class="option-input radio change_groups"  value="' + value['id'] + '" name="group[' + value['id'] + ']">' + value['name'] + '</label>';
                });

                $.each(fanlar, function(key, value) {
                    html3 = html3 + '<label style="padding: 0 10px 0 0;"><input checked type="checkbox" class="option-input radio"  value="' + value['id'] + '" name="fanlar[' + value['id'] + ']">' + value['name'] + '</label>';

                });
                $.each(fanlar, function(key, value) {
                    html4 = html4 + '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                });
                $('#fan_change').html(html4);

                $('#direction').html(html);
                $('#groups').html(html2);
                $('#fanlar').html(html3);


            }
        });
    }
});
$('#direction').change(function() {
    if ($(this).val() != '') {
        var direction_id = $(this).val();
        var url = '../../../backend/exam-permission/ajaxcourse/';
        $.ajax({
            url: url,
            method: "GET",
            data: { direction_id: direction_id },
            success: function(result) {
                var course = (result.course);
                var groups = (result.groups);
                var fanlar = (result.fanlar);

                var html = '<option value="0" style="display:none">Kursni tanlang</option>';
                var html4 = '<option value="" required style="display:none">-Fanni tanlang-</option>';
                var html2 = '';
                var html3 = '';
                $.each(course, function(key, value) {
                    html = html + '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                });
                $.each(groups, function(key, value) {
                    html2 = html2 + '<label style="padding: 0 10px 0 0;"><input checked type="checkbox" class="option-input radio change_groups"  value="' + value['id'] + '" name="group[' + value['id'] + ']">' + value['name'] + '</label>';
                });

                $.each(fanlar, function(key, value) {
                    html3 = html3 + '<label style="padding: 0 10px 0 0;"><input checked type="checkbox" class="option-input radio"  value="' + value['id'] + '" name="fanlar[' + value['id'] + ']">' + value['name'] + '</label>';

                });
                $.each(fanlar, function(key, value) {
                    html4 = html4 + '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                });
                $('#fan_change').html(html4);
                $('#course').html(html);
                $('#groups').html(html2);
                $('#fanlar').html(html3);

            }
        });
    }
});
$('#course').change(function() {
    if ($(this).val() != '') {
        var course_id = $(this).val();
        var direction_id = $('#direction').val();
        var url = '../../../backend/exam-permission/ajaxgroups/';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                course_id: course_id,
                direction_id: direction_id,
            },
            success: function(result) {
                var groups = (result.groups);
                var fanlar = (result.fanlar);
                var html = '<option value="0" style="display:none">Kursni tanlang</option>';
                var html4 = '<option value="" required style="display:none">-Fanni tanlang--</option>';
                var html2 = '';
                var html3 = '';
                $.each(groups, function(key, value) {
                    html2 = html2 + '<label style="padding: 0 10px 0 0;"><input checked type="checkbox" class="option-input radio change_groups"  value="' + value['id'] + '" name="group[' + value['id'] + ']">' + value['name'] + '</label>';
                });
                $.each(fanlar, function(key, value) {
                    html3 = html3 + '<label style="padding: 0 10px 0 0;"><input checked type="checkbox" class="option-input radio"  value="' + value['id'] + '" name="fanlar[' + value['id'] + ']">' + value['name'] + '</label>';
                });
                $.each(fanlar, function(key, value) {
                    html4 = html4 + '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                });
                $('#fan_change').html(html4);
                $('#groups').html(html2);
                $('#fanlar').html(html3);

            }
        });
    }
});
$(document).ready(function() {





    bsCustomFileInput.init();
});


$('#check_teachecher_count').click(function() {
    var uz_count = $('#uz_count').val();
    var ru_count = $('#ru_count').val();
    var en_count = $('#en_count').val();

    var sum_uz = 0;
    var sum_ru = 0;
    var sum_en = 0;

    $('.uz_teacher').each(function() {
        sum_uz += Number($(this).val());
    });
    $('.ru_teacher').each(function() {
        sum_ru += Number($(this).val());
    });
    $('.en_teacher').each(function() {
        sum_en += Number($(this).val());
    });

    if ((uz_count == sum_uz) && (ru_count == sum_ru) && (en_count == sum_en)) {
        $("#primary").trigger("click");
    } else {
        $("#danger").trigger("click");

    }

});

$(".zafarbut").click(function(){
   
    var te = parseInt($("input.zafarin1").val());
    $(".zafarin2").val(te);
    
});


var aa = $("li.nav-item a.index_a").click(function(){
    $(this).next().children().toggleClass("shokir");
});
$("li.nav-item a").click(function(){
    $(this).addClass("shmk");
    $("li.nav-item a").not(this).removeClass("shmk");
});


var uploadField = document.getElementById("exampleInputFile");

uploadField.onchange = function() {

    if(this.files[0].size > 5242800){
       alert("Bunday katta hajmdagi ma'lumot yuklashga ruxsat berilmagan. Kichikroq fayl tanlang!");
       this.value = "";
    };
};
var uploadField = document.getElementById("exampleInputFile2");

uploadField.onchange = function() {

    if(this.files[0].size > 5242800){
       alert("Bunday katta hajmdagi ma'lumot yuklashga ruxsat berilmagan. Kichikroq fayl tanlang!");
       this.value = "";
    };
};
var uploadField = document.getElementById("exampleInputFile3");

uploadField.onchange = function() {

    if(this.files[0].size > 5242800){
       alert("Bunday katta hajmdagi ma'lumot yuklashga ruxsat berilmagan. Kichikroq fayl tanlang!");
       this.value = "";
    };
};
var uploadField = document.getElementById("exampleInputFile4");

uploadField.onchange = function() {

    if(this.files[0].size > 5242800){
       alert("Bunday katta hajmdagi ma'lumot yuklashga ruxsat berilmagan. Kichikroq fayl tanlang!");
       this.value = "";
    };
};
var uploadField = document.getElementById("exampleInputFile5");

uploadField.onchange = function() {

    if(this.files[0].size > 5242800){
       alert("Bunday katta hajmdagi ma'lumot yuklashga ruxsat berilmagan. Kichikroq fayl tanlang!");
       this.value = "";
    };
};
var uploadField = document.getElementById("exampleInputFile6");

uploadField.onchange = function() {

    if(this.files[0].size > 5242800){
       alert("Bunday katta hajmdagi ma'lumot yuklashga ruxsat berilmagan. Kichikroq fayl tanlang!");
       this.value = "";
    };
};