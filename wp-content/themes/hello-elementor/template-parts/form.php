<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<form id="__vtigerWebForm" name="Vendas" action="https://crm.consors.com.br/modules/Webforms/capture.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <input type="hidden" name="__vtrftk" value="sid:1af6faabf5f7e0284a4408e850a588b2b93dc90a,1589976805" />
    <input type="hidden" name="publicid" value="6779ef6bd374b23c86761ecead0d6382" /><input type="hidden" name="urlencodeenable" value="1" /><input type="hidden" name="name" value="Vendas" />
    <fieldset id="primeira-etapa">
        <div class="row">
            <div class="col-lg-6" style="padding-left:0px">
                <input class="form-control name" type="text" name="firstname" id="nome" title="Nome" placeholder="Seu nome">
            </div>
            <div class="col-lg-6" style="padding-left:0px">
                <input class="form-control name" type="text" name="lastname" placeholder="Seu sobrenome">
            </div>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col-lg-4 pl-0">
                <input class="form-control name" type="text" placeholder="Informe seu e-mail" name="email" id="email" title="email">
            </div>
            <div class="col-lg-4 pl-0">
                <input class="form-control name" type="text" placeholder="Telefone com (DDD)" name="phone" id="phone" title="telefone" onKeyDown="Mascara(this,Telefone)" onKeyPress="Mascara(this,Telefone)" onKeyUp="Mascara(this,Telefone)" maxlength="15">
            </div>
            <div class="col-lg-4 pl-0 left_position_fix">
                <input class="form-control name" type="text" placeholder="WhatsApp com (DDD)" name="cf_852" id="cf_852" onKeyDown="Mascara(this,Telefone)" onKeyPress="Mascara(this,Telefone)" onKeyUp="Mascara(this,Telefone)" maxlength="15">
            </div>
        </div>
    </fieldset>
    <fieldset id="segunda-etapa">
        <div class="row" style="margin-top:10px">
            <div class="col-lg-6" style="padding-left:0px">
                <input class="form-control name" type="text" placeholder="Administradora do seu Consórcio" name="cf_854" id="cf_854">
            </div>
            <div class="col-lg-6 left_position_fix">
                <input class="form-control name" type="text" placeholder="Grupo" name="cf_856" id="cf_856">
            </div>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col-lg-6" style="padding-left:0px">
                <select class="form-control name" name="cf_858" id="cf_858" style="width:100%;margin-top:12px;color:#999">
                    <option value="">Tipo do Consórcio</option>
                    <option value="Imóveis">Imóveis</option>
                    <option value="Automóveis">Automóveis</option>
                    <option value="Caminhões">Caminhões</option>
                    <option value="Motos">Motos</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>
            <div class="col-lg-6 left_position_fix">
                <select class="form-control name" name="cf_860" id="cf_860" style="width:100%;margin-top:12px;color:#999">
                    <option value="">Está Contemplado?</option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col-lg-6" style="padding-left:0px">
                <input class="form-control name" type="text" placeholder="Crédito do seu Consórcio" name="cf_862" id="cf_862" title="credito" onKeyPress="return(MascaraMoeda(this,'.',',',event))" />
            </div>
            <div class="col-lg-6 left_position_fix">
                <input class="form-control name" type="text" placeholder="Saldo devedor (em reais)" name="cf_864" id="cf_864" onKeyPress="return(MascaraMoeda(this,'.',',',event))" />
            </div>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col-lg-6" style="padding-left:0px">
                <input class="form-control name" type="text" placeholder="% já pago" name="cf_866" id="cf_866">
            </div>
            <div class="col-lg-6 left_position_fix">
                <input class="form-control name" type="text" placeholder="Valor pretendido para venda" name="cf_868" id="cf_868" title="valor_pretendido" onKeyPress="return(MascaraMoeda(this,'.',',',event))" />
            </div>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col-lg-12" style="padding-left:0px">
                <textarea class="form-control name" placeholder="Informações Adicionais" name="cf_870" id="cf_870" style="height:100px"></textarea>
            </div>
        </div>
    </fieldset>
    <div class="row">
        <div class="col-lg-4 form-actions" style="padding-left:0px; border-radius: 10px; margin-top: 10px;">
            <button type="submit" class="submit" style="background:#ec5e16;color:#fff;padding:15px;border:0; font-family:Gotham-Black !important;">Solicitar
                proposta <i class="fa fa-arrow-circle-right" style="color: white;"></i></button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function() {
        console.log("foi");
    });

    window.onload = function() {
        var N = navigator.appName,
            ua = navigator.userAgent,
            tem;
        var M = ua.match(
            /(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i
        );
        if (M && (tem = ua.match(/version\/([\.\d]+)/i)) != null)
            M[2] = tem[1];
        M = M ? [M[1], M[2]] : [N, navigator.appVersion, "-?"];
        var browserName = M[0];
        var form = document.getElementById("__vtigerWebForm"),
            inputs = form.elements;
        form.onsubmit = function() {
            var required = [],
                att,
                val;
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
                            alert(
                                "For " +
                                elemLabel +
                                " field please enter valid email address"
                            );
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
            var numberTypeInputs = document.querySelectorAll(
                "input[type=number]"
            );
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
                        alert(
                            "For " + elemLabel + " field please enter valid number"
                        );
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
                        alert(
                            "For " +
                            elemLabel +
                            " field please enter valid date in required format"
                        );
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
    };
</script>