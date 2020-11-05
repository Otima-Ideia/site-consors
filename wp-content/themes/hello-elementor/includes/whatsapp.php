<style>
    /*popup whatsapp*/

    .whats {
        position: fixed;
        bottom: 15px;
        left: 25px;
        z-index: 3;
        max-width: 320px;
        width: calc(100% - 50px);
    }

    .whats .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    .whats__form {
        display: none;
    }

    .whats__form.active {
        display: block;
    }

    .whats__name {
        background: #056056;
    }

    .whats__name img {
        width: 27px;
        height: 27px;
        -o-object-position: left;
        object-position: left;
        -o-object-fit: contain;
        object-fit: contain;
        background-color: #ffffff;
        border-radius: 27px;
        margin: 11px 12px;
    }

    .whats__name span,
    .whats__name div {
        line-height: 49px;
        color: #ffffff;
    }

    .whats__name img,
    .whats__name span {
        display: block;
        float: left;
    }

    .whats__name div {
        float: right;
        cursor: pointer;
        margin-right: 16px;
    }

    .whats__msgs {
        background-image: url(https://consors.com.br/wp-content/themes/hello-elementor/assets/images/whatsapp-bg.jpeg);
        background-size: cover;
        padding: 15px 20px 3px 20px;
        min-height: 140px;
    }

    .whats__msg {
        display: none;
        background-color: #ffffff;
        color: #262626;
        font-size: 14px;
        padding: 8px 58px 8px 12px;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        position: relative;
        -webkit-box-shadow: 1px 1px 2px #ccc;
        box-shadow: 1px 1px 2px #ccc;
        margin-bottom: 12px;
    }

    .whats__msg span {
        position: absolute;
        display: inline-block;
        bottom: 2px;
        right: 10px;
        line-height: 17px;
        font-size: 11px;
        color: #929292;
    }

    .whats__msg:after {
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid #ffffff;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        display: block;
        content: "";
        position: absolute;
        left: 0;
        top: 0;
    }

    .whats form {
        background: #f5f1ee;
        padding: 12px 10px;
        z-index: 9999;
    }

    .whats form table {
        table-layout: fixed;
        width: 100%;
    }

    .whats form #nome.wpcf7-not-valid,
    .whats form #tel.wpcf7-not-valid {
        border: 1px solid #ff8989;
    }

    .whats form #enviarWPbtn {
        text-indent: -99999px;
        /*width: 30px;*/
        background-image: url(https://consors.com.br/wp-content/themes/hello-elementor/assets/images/download.jpg);
        background-repeat: no-repeat;
        background-position: center;
        border: none;
        background-color: transparent;
        height: 38px;
        cursor: pointer;
    }

    .whats form input {
        height: 32px;
    }

    .whats form input::-webkit-input-placeholder {
        font-size: 14px;
        color: black;
    }

    .whats form input::-moz-placeholder {
        font-size: 14px;
        color: black;
    }

    .whats form input:-ms-input-placeholder {
        font-size: 14px;
        color: black;
    }

    .whats form input::-ms-input-placeholder {
        font-size: 14px;
        color: black;
    }

    .whats form input::placeholder,
    .whats form input {
        font-size: 14px;
        color: black;
        width: 100%;
    }

    .whats form p {
        margin: 0;
    }

    .clearfix {
        zoom: 1;
    }

    .whats form .wpcf7-not-valid-tip {
        display: none;
    }

    .whats form .wpcf7-response-output {
        display: none !important;
    }

    div.wpcf7 .ajax-loader {
        display: none !important;
    }

    .whats .ajax-loader {
        display: none !important;
    }

    .whats__btn {
        margin-top: 14px;
        display: inline-block;
        cursor: pointer;
        position: relative;
    }

    .whats__btn .wt {
        width: 52px;
        height: auto;
    }

    .whats__btn span {
        -webkit-animation-name: pulo;
        -webkit-animation-duration: 0.3s;
        animation-name: pulo;
        animation-duration: 0.3s;
        display: block;
        position: absolute;
        right: -5px;
        top: -5px;
        /* width: 20px; */
        /* height: 20px; */
        font-size: 13px;
        text-align: center;
        color: #ffffff;
        border-radius: 50%;
        background-color: #ff8000;
        border: 2px solid #fff;
        padding: 5px 8px;
    }

    .whats form #nome,
    .whats form #tel {
        float: unset;
        width: 92%;
        height: 32px;
        border: 0;
        margin-bottom: 7px;
    }

    .whats form #email {
        border: 0;
    }


    @-webkit-keyframes pulo {
        0% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }

        50% {
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }
    }

    @keyframes pulo {
        0% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }

        50% {
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }
    }

    .input-hidden {
        position: absolute;
        visibility: hidden;
        width: 0;
        height: 0;
    }

    .whats-row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;

    }

    .whats-col-md-6 {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
        position: relative;
        width: 100%;
        min-height: 1px;

    }

    .whats-col-md-9 {
        -ms-flex: 0 0 75%;
        flex: 0 0 75%;
        max-width: 75%;
        position: relative;
        width: 100%;
        min-height: 1px;

    }

    .whats-col-md-3 {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
        position: relative;
        width: 100%;
        min-height: 1px;

    }

 
</style>
<div class="whats">
        <div class="whats__form">
            <div class="whats__name clearfix">
                <span>Consors</span>
                <div>X</div>
            </div>
            <div class="whats__msgs">
                <div class="whats__msg m1">
                    Olá<span>14:24</span>
                </div>
                <div class="whats__msg m2">
                    Quer saber mais informações sobre a Consors?<span>14:24</span>
                </div>
                <div class="whats__msg m3">
                    Entre em contato via whatsapp<span>14:24</span>
                </div>
            </div>
            <div >

      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <form id="__vtigerWebForm" name="Whatsapp" action="https://crm.consors.com.br/modules/Webforms/capture.php" method="post" accept-charset="utf-8" enctype="multipart/form-data"><input type="hidden" name="__vtrftk" value="sid:4b149a21cfa0f03fa77e6b413aa6f09ab11e7c1d,1592509074"><input type="hidden" name="publicid" value="9368829891ddd0aa33e6cdcef4130120"><input type="hidden" name="urlencodeenable" value="1"><input type="hidden" name="name" value="Whatsapp">
                <div class="whats-row">
                    <div class="whats-col-md-6">
                        <input type="text" id="nome" name="firstname" data-label="" value="" required="" placeholder="Nome">
                    </div>
                    <div class="whats-col-md-6">
                        <input type="text" id="tel" class="phone" name="lastname" data-label="" value="" required="" placeholder="Sobrenome">
                    </div>
                    <div class="whats-col-md-9">
                        <input type="email" id="email" name="email" data-label="" value="" required="" placeholder="E-mail">
                    </div>
                    <div class="whats-col-md-3">
                        <input type="submit" value="Enviar" id="enviarWPbtn">
                    </div>

                    </div>

            </form>
            <script type="text/javascript">
                window.onload = function() {
                    var N = navigator.appName,
                        ua = navigator.userAgent,
                        tem;
                    var M = ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
                    if (M && (tem = ua.match(/version\/([\.\d]+)/i)) != null) M[2] = tem[1];
                    M = M ? [M[1], M[2]] : [N, navigator.appVersion, "-?"];
                    var browserName = M[0];
                    var form = document.getElementById("__vtigerWebForm"),
                        inputs = form.elements;
                    form.onsubmit = function() {
                        var required = [],
                            att, val;
                        for (var i = 0; i < inputs.length; i++) {
                            att = inputs[i].getAttribute("required");
                            val = inputs[i].value;
                            type = inputs[i].type;
                            if (type == "email") {
                                if (val != "") {
                                    var elemLabel = inputs[i].getAttribute("label");
                                    var emailFilter = /^[_/a-zA-Z0-9]+([!"#$%&()*+,./:;<=>?\^_`{|}~-]?[a-zA-Z0-9/_/-])*@[a-zA-Z0-9]+([\_\-\.]?[a-zA-Z0-9]+)*\.([\-\_]?[a-zA-Z0-9])+(\.?[a-zA-Z0-9]+)?$/;
                                    var illegalChars = /[\(\)\<\>\,\;\:\"\[\]]/;
                                    if (!emailFilter.test(val)) {
                                        alert("For " + elemLabel + " field please enter valid email address");
                                        return false;
                                    } else if (val.match(illegalChars)) {
                                        alert(elemLabel + " field contains illegal characters");
                                        return false;
                                    }
                                }
                            }
                            if (att != null) {
                                if (val.replace(/^\s+|\s+$/g, "") == "") {
                                    required.push(inputs[i].getAttribute("label"));
                                }
                            }
                        }
                        if (required.length > 0) {
                            alert("The following fields are required: " + required.join());
                            return false;
                        }
                        var numberTypeInputs = document.querySelectorAll("input[type=number]");
                        for (var i = 0; i < numberTypeInputs.length; i++) {
                            val = numberTypeInputs[i].value;
                            var elemLabel = numberTypeInputs[i].getAttribute("label");
                            var elemDataType = numberTypeInputs[i].getAttribute("datatype");
                            if (val != "") {
                                if (elemDataType == "double") {
                                    var numRegex = /^[+-]?\d+(\.\d+)?$/;
                                } else {
                                    var numRegex = /^[+-]?\d+$/;
                                }
                                if (!numRegex.test(val)) {
                                    alert("For " + elemLabel + " field please enter valid number");
                                    return false;
                                }
                            }
                        }
                        var dateTypeInputs = document.querySelectorAll("input[type=date]");
                        for (var i = 0; i < dateTypeInputs.length; i++) {
                            dateVal = dateTypeInputs[i].value;
                            var elemLabel = dateTypeInputs[i].getAttribute("label");
                            if (dateVal != "") {
                                var dateRegex = /^[1-9][0-9]{3}-(0[1-9]|1[0-2]|[1-9]{1})-(0[1-9]|[1-2][0-9]|3[0-1]|[1-9]{1})$/;
                                if (!dateRegex.test(dateVal)) {
                                    alert("For " + elemLabel + " field please enter valid date in required format");
                                    return false;
                                }
                            }
                        }
                        var inputElems = document.getElementsByTagName("input");
                        var totalFileSize = 0;
                        for (var i = 0; i < inputElems.length; i++) {
                            if (inputElems[i].type.toLowerCase() === "file") {
                                var file = inputElems[i].files[0];
                                if (typeof file !== "undefined") {
                                    var totalFileSize = totalFileSize + file.size;
                                }
                            }
                        }
                        if (totalFileSize > 52428800) {
                            alert("Maximum allowed file size including all files is 50MB.");
                            return false;
                        }
                    };
                }
            </script>

</div>        
</div>








        <div class="whats__btn">
            <img title="WhatsApp" alt="WhatsApp" class="wt" src="https://consors.com.br/wp-content/themes/hello-elementor/assets/images/whatsapp-agencia-boa-ideia.png">
            <span style="display: none;">1</span>
        </div>
    </div>









<script type="text/javascript">



// 	Whatsapp popup

  var whatsAtivo = 0;
  function m1() {
    jQuery(".whats__btn span").css("display", "block");

    jQuery(".m1").css("display", "inline-block");

    var dot = jQuery(".whats__btn span");
    var newdot = dot.clone(true);
    dot.before(newdot);
    jQuery(".whats__btn span:last").remove();
  }
  function m2() {
    jQuery(".m2").css("display", "inline-block");

    var dot = jQuery(".whats__btn span");
    var newdot = dot.clone(true);
    dot.before(newdot);
    jQuery(".whats__btn span:last").remove();
    jQuery(".whats__btn span").html("2");
  }
  function m3() {
    jQuery(".m3").css("display", "inline-block");

    var dot = jQuery(".whats__btn span");
    var newdot = dot.clone(true);
    dot.before(newdot);
    jQuery(".whats__btn span:last").remove();
    jQuery(".whats__btn span").html("3");
    jQuery(".whats__btn span").addClass("fim");
  }
  var timeoutID1;
  var timeoutID2;
  var timeoutID3;
  function delayedAlert() {
    timeoutID1 = window.setTimeout(m1, 1000);
    timeoutID2 = window.setTimeout(m2, 3000);
    timeoutID3 = window.setTimeout(m3, 6000);
  }
  jQuery("#nomeWhats").click(function () {
    jQuery(".fim").hide();
  });
  jQuery("#telWhats").click(function () {
    jQuery(".fim").hide();
  });
  jQuery(".whats__btn").click(function () {
    jQuery(".whats__form").toggleClass("active");
    var dt = new Date();
    var time = dt.getHours() + ":" + dt.getMinutes();
    jQuery(".whats__msg").each(function () {
      jQuery(this).children("span").text(time);
    });
    if (whatsAtivo == 0) {
      delayedAlert();
      whatsAtivo = 1;
    }
  });
  jQuery(".whats__name div").click(function () {
    jQuery(".whats__form").toggleClass("active");
  });

 
  
</script>
