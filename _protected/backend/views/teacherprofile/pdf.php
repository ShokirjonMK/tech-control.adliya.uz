<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<style>
  div.all_scroll{
      height: 100vh;
      width: 100%;
      overflow-y: scroll;
      position: relative;
    }
    div.all{
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
    }
    div.all_scroll canvas{
      border: 1px solid silver;
      margin: 0 auto;
      margin-bottom: 15px;
      
    }
    div.content_zaf{
      display: flex;
      
    }
    div.top_pdf{
      position: absolute;
      top: 0;
      left: 0;
      display: flex;
      width: 98%;
      justify-content: space-between;
      background-color: silver;
      padding:15px 0px 15px 15px;
    }
    div.top_test{
      height: 60px;
    }
</style>

<section class="content" style="height: 100% !iportant;">
   <div class="room-form">

                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'description')->textarea(['rows' => '3', 'maxlength'=>220])->label('Izoh') ?>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row">
                                        <div class="col-sm-12">

                                    <?= $form->field($model, 'mark')->input('number', ['min'=>0,'max'=>$maxball])->label('Ball') ?>
                                        </div>

                                        <div class="col-sm-12 pb-2" style="margin-top: -24px;">

                                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style'=>'width:100%;margin-top:32px ']) ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>   
<div class="content_zaf">
      <div class="all_scroll">
        <div class="top_test"></div>
        <div class="top_pdf">
          <span class="page-info">
            <b>Fayl varaqlari soni: </b> <span id="page-count"></span>
            <button onclick="getPDF()">ok</button>
           </span>
           <div class="right_items">
            O'lcham : <select id="selWidth">
              <option value="0.5">1</option>
              <option value="1" selected="selected">2</option>
              <option value="1.5">3</option>
              <option value="2">4</option>
              <option value="2.5" >5</option>
              <option value="3">6</option>
            </select>
            Rang : 
            <input type="color"  value="#ff0000" id="selColor">
          </div>
        </div>
        <div class="all">
        </div>
      </div>
      
    </div>

</section>

   <script type="text/javascript">
     var mousePressed = false;
    var lastX, lastY;
       setTimeout(() => {
    
    var ctx;


  ctx = document.getElementById('pdf-render1').getContext("2d");

    $('#pdf-render1').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#pdf-render1').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#pdf-render1').mouseup(function (e) {
        mousePressed = false;
    });
      $('#pdf-render1').mouseleave(function (e) {
        mousePressed = false;
    });


function Draw(x, y, isDown) {
    if (isDown) {
        ctx.beginPath();
        ctx.strokeStyle = $('#selColor').val();
        ctx.lineWidth = $('#selWidth').val();
        ctx.lineJoin = "round";
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.closePath();
        ctx.stroke();
    }
    lastX = x; lastY = y;
}
  

    }, 2500);


     setTimeout(() => {

    var ctx2;


  ctx2 = document.getElementById('pdf-render2').getContext("2d");

    $('#pdf-render2').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#pdf-render2').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#pdf-render2').mouseup(function (e) {
        mousePressed = false;
    });
      $('#pdf-render2').mouseleave(function (e) {
        mousePressed = false;
    });


function Draw(x, y, isDown) {
    if (isDown) {
        ctx2.beginPath();
        ctx2.strokeStyle = $('#selColor').val();
        ctx2.lineWidth = $('#selWidth').val();
        ctx2.lineJoin = "round";
        ctx2.moveTo(lastX, lastY);
        ctx2.lineTo(x, y);
        ctx2.closePath();
        ctx2.stroke();
    }
    lastX = x; lastY = y;
}
  

    }, 2500);



  setTimeout(() => {

    var ctx3;


  ctx3 = document.getElementById('pdf-render3').getContext("2d");

    $('#pdf-render3').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#pdf-render3').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#pdf-render3').mouseup(function (e) {
        mousePressed = false;
    });
      $('#pdf-render3').mouseleave(function (e) {
        mousePressed = false;
    });


function Draw(x, y, isDown) {
    if (isDown) {
        ctx3.beginPath();
        ctx3.strokeStyle = $('#selColor').val();
        ctx3.lineWidth = $('#selWidth').val();
        ctx3.lineJoin = "round";
        ctx3.moveTo(lastX, lastY);
        ctx3.lineTo(x, y);
        ctx3.closePath();
        ctx3.stroke();
    }
    lastX = x; lastY = y;
}
  

    }, 2500);

  setTimeout(() => {

    var ctx4;


  ctx4 = document.getElementById('pdf-render4').getContext("2d");

    $('#pdf-render4').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#pdf-render4').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#pdf-render4').mouseup(function (e) {
        mousePressed = false;
    });
      $('#pdf-render4').mouseleave(function (e) {
        mousePressed = false;
    });


function Draw(x, y, isDown) {
    if (isDown) {
        ctx4.beginPath();
        ctx4.strokeStyle = $('#selColor').val();
        ctx4.lineWidth = $('#selWidth').val();
        ctx4.lineJoin = "round";
        ctx4.moveTo(lastX, lastY);
        ctx4.lineTo(x, y);
        ctx4.closePath();
        ctx4.stroke();
    }
    lastX = x; lastY = y;
}
  

    }, 2500);




  setTimeout(() => {

    var ctx5;


  ctx5 = document.getElementById('pdf-render5').getContext("2d");

    $('#pdf-render5').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#pdf-render5').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#pdf-render5').mouseup(function (e) {
        mousePressed = false;
    });
      $('#pdf-render5').mouseleave(function (e) {
        mousePressed = false;
    });


function Draw(x, y, isDown) {
    if (isDown) {
        ctx5.beginPath();
        ctx5.strokeStyle = $('#selColor').val();
        ctx5.lineWidth = $('#selWidth').val();
        ctx5.lineJoin = "round";
        ctx5.moveTo(lastX, lastY);
        ctx5.lineTo(x, y);
        ctx5.closePath();
        ctx5.stroke();
    }
    lastX = x; lastY = y;
}
  

    }, 2500);

setTimeout(() => {

    var ctx6;


  ctx6 = document.getElementById('pdf-render6').getContext("2d");

    $('#pdf-render6').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#pdf-render6').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#pdf-render6').mouseup(function (e) {
        mousePressed = false;
    });
      $('#pdf-render6').mouseleave(function (e) {
        mousePressed = false;
    });


function Draw(x, y, isDown) {
    if (isDown) {
        ctx6.beginPath();
        ctx6.strokeStyle = $('#selColor').val();
        ctx6.lineWidth = $('#selWidth').val();
        ctx6.lineJoin = "round";
        ctx6.moveTo(lastX, lastY);
        ctx6.lineTo(x, y);
        ctx6.closePath();
        ctx6.stroke();
    }
    lastX = x; lastY = y;
}
  

    }, 2500);

setTimeout(() => {

    var ctx7;


  ctx7 = document.getElementById('pdf-render7').getContext("2d");

    $('#pdf-render7').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#pdf-render7').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#pdf-render7').mouseup(function (e) {
        mousePressed = false;
    });
      $('#pdf-render7').mouseleave(function (e) {
        mousePressed = false;
    });


function Draw(x, y, isDown) {
    if (isDown) {
        ctx7.beginPath();
        ctx7.strokeStyle = $('#selColor').val();
        ctx7.lineWidth = $('#selWidth').val();
        ctx7.lineJoin = "round";
        ctx7.moveTo(lastX, lastY);
        ctx7.lineTo(x, y);
        ctx7.closePath();
        ctx7.stroke();
    }
    lastX = x; lastY = y;
}
  

    }, 2500);


setTimeout(() => {

    var ctx8;


  ctx8 = document.getElementById('pdf-render8').getContext("2d");

    $('#pdf-render8').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#pdf-render8').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#pdf-render8').mouseup(function (e) {
        mousePressed = false;
    });
      $('#pdf-render8').mouseleave(function (e) {
        mousePressed = false;
    });


function Draw(x, y, isDown) {
    if (isDown) {
        ctx8.beginPath();
        ctx8.strokeStyle = $('#selColor').val();
        ctx8.lineWidth = $('#selWidth').val();
        ctx8.lineJoin = "round";
        ctx8.moveTo(lastX, lastY);
        ctx8.lineTo(x, y);
        ctx8.closePath();
        ctx8.stroke();
    }
    lastX = x; lastY = y;
}
  

    }, 2500);

setTimeout(() => {

    var ctx9;


  ctx9 = document.getElementById('pdf-render9').getContext("2d");

    $('#pdf-render9').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#pdf-render9').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#pdf-render9').mouseup(function (e) {
        mousePressed = false;
    });
      $('#pdf-render9').mouseleave(function (e) {
        mousePressed = false;
    });


function Draw(x, y, isDown) {
    if (isDown) {
        ctx9.beginPath();
        ctx9.strokeStyle = $('#selColor').val();
        ctx9.lineWidth = $('#selWidth').val();
        ctx9.lineJoin = "round";
        ctx9.moveTo(lastX, lastY);
        ctx9.lineTo(x, y);
        ctx9.closePath();
        ctx9.stroke();
    }
    lastX = x; lastY = y;
}
  

    }, 2500);




   </script>

   <?php $x = $exam_answer->answer_pdf; ?>
   <input id="test_aa" type="text" value='<?=$x;?>' name="">
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    
     <script type="text/javascript">
       // const url = '../docs/pdf.pdf';
       setTimeout(()=>{

console.log("url");
var aa = $("#test_aa");

// alert(aa.val());
const url = 'http://tech-control.adliya.uz/uploads/answer/' + aa.val();


// const url = 'http://adliya.vatanparvar.uz/uploads/document/shartnoma/1583316204077.pdf';
var pdfDoc = null, pageNum = 1, pageIsRendering = false, pageNumIsPending = null;
const scale = 2;
// const canvas = document.querySelector('#pdf-render'), ctx = canvas.getContext('2d');

    const renderPage = num => {
        pageIsRendering = true;
        canvas = document.querySelector('#pdf-render' + num);
        ctx = canvas.getContext('2d');
        
        pdfDoc.getPage(num).then(page => {
        
        const viewport = page.getViewport({ scale });
        document.querySelector('#pdf-render'+num).height = viewport.height;
        document.querySelector('#pdf-render'+num).width = viewport.width;

        const renderCtx = {
            canvasContext: ctx, viewport
        }

        page.render(renderCtx).promise.then(() => {
            pageIsRendering = false;
            if(pageNumIsPending !== null){
                renderPage(pageNumIsPending);
                pageNumIsPending = null;
            }
        });

    });
    
}

const queueRenderingPage = num => {
    if(pageIsRendering){
        pageNumIsPending = num;
    }
    else{
        renderPage(num);
    }
}

setTimeout(() => {
  queueRenderingPage(1);

    setInterval(() => {
        if(pageNum >= pdfDoc.numPages){
            return;
        }
        
                pageNum++;
        queueRenderingPage(pageNum);
    }, 1500);
}, 2400);



// =========================
pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {

    pdfDoc = pdfDoc_;
    
    document.querySelector('#page-count').textContent = pdfDoc.numPages;
  

});

    setTimeout(function(){
        var n = parseInt($("#page-count").html());
        for(var i = 1; i<=n; i++){
            $(".all").append("<canvas class='pdf-rende' id='pdf-render" + i + "'></canvas>");
        }
    },1500);
       }, 200);
   </script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script type="text/javascript">
  function getPDF(){
 
 var HTML_Width = $(".all").children().width();
 var HTML_Height = $(".all").height();
 var top_left_margin = 10;
 var PDF_Width = HTML_Width;
 var PDF_Height = $(".all").children().height()+top_left_margin;
 var canvas_image_width = HTML_Width;
 var canvas_image_height = HTML_Height;
 
 var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
 
 html2canvas($(".all")[0],{allowTaint:true}).then(function(canvas) {
   canvas.getContext('2d');
   
   console.log(canvas.height+"  "+canvas.width);
   
   
   var imgData = canvas.toDataURL("image/jpeg", 1.0);
   var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
   pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
   
   
   for (var i = 1; i <= totalPDFPages; i++) { 
     pdf.addPage(PDF_Width, PDF_Height);
     pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i),canvas_image_width,canvas_image_height);
   }
   
   pdf.save("CheckedPdf.pdf");
 });
};
</script>