
function getHtmlForParameter(item) {
    var string = "";
    var labelRange = getLabelRange(item);
    var labelRangeText = labelRange;
    
    if(labelRange != " ")
        labelRangeText = " <i>(" + labelRangeText+")</i>";

    string += "<h2>Parameter " +  item.Name[0] + labelRangeText +"</h2>";
    string += '<input type="number" step="0.1" id="' + item.Name[0] + '" name="' + item.Name[0] +'" ' + getNumericStepperRange(item)  + ' required />';

    if(labelRange != " ")
        string += '<span id="info-' + item.Name[0] + '" name="info-' + item.Name[0] +'" class="parameter-error-info"> * Value must be ' + labelRange + ' </span>';
    
    string += '<span class="parameter-ok-info" id="ok-' + item.Name[0] + '" name="ok-' + item.Name[0] +'" style="display: none;"></span>';

    return string;
}

function getNumericStepperRange(item){
    var min = '';
    var max = '';

    if(item.Minore[0]){
        max = 'max="' +item.Minore[0] +'"';
    }
    if(item.Maggiore[0]){
        min = 'min="' +item.Maggiore[0] +'"';
    }

    return min + max;
}

function getLabelRange(item) {
    var min = "";
    var max = "";

    if(item.Minore[0]){
        max = "fino a " + item.Minore[0];
    }

    if(item.Maggiore[0]){
        min = "da " + item.Maggiore[0];
    }

    return min + " " + max;

}

$(document).ready(function () {

    function LoadXMLData(){
        var xml = $("#XmlDataParameter").val();
        $.ajax({
            type: "POST",
            url: "./api/evaluate.php",
            data: {
                xml: xml
            },
            success: function (result) {
                if (result.success) {
                    $("#parametersDiv").empty();
                    $("#output").text("...");

                    for(var i = 0; i< result.items.length; i++){
                        var p = result.items[i];
                        if(p.Name && p.Name[0])
                            $("#parametersDiv").append(getHtmlForParameter(p)); 
                    }

                } else {
                    alert('something goes wrong:\n' + result.message);
                }
            },
            error: function (result) {
                alert('error: ' + result);
            }
        });
    }

    LoadXMLData();

    $("#ReloadBtn").click(function (e) {
        e.preventDefault();

        LoadXMLData();

    });

    $("#EvaluateBtn").click(function (e) {
        e.preventDefault();
        var children = $("#parametersDiv").find("input");
        var validateAll = true;
        for(var i = 0; i<children.length; i++) {
            var child = $(children[i]);
            var name = child.attr("Name");
            var val = parseFloat(children[i].value);
            var validate = true;

            if(val){
                var min = child.prop("min");
                if(min)
                    validate &= (val >= parseFloat(min)); 

                var max = child.prop("max");
                if(max)
                    validate &= (val <= parseFloat(max)); 

                if(validate){
                    $( "#info-" + name).hide();
                    $( "#ok-" + name).show();
                    child.removeClass("validate-error").addClass("validate-ok");
                } else{
                    $( "#info-" + name).show();
                    $( "#ok-" + name).hide();
                    child.removeClass("validate-ok").addClass("validate-error");
                }
            } else{
                validate = false;
                $( "#info-" + name).show();
                $( "#ok-" + name).hide();
                child.removeClass("validate-ok").addClass("validate-error");
            }
            validateAll &= validate;

        }

        if(validateAll) {
            $("#output").text("89.0001");
        } else{
            alert("Must validate parameters");
        }
        
    });

    $("#StoreBtn").click(function (e) {
        e.preventDefault();

        var xml = $("#XmlDataParameter").text();
        var output= $("#output").text();

        $.ajax({
            type: "POST",
            url: "./api/submitdata.php",
            data: {
                xml: xml,
                output: output
            },
            success: function (result) {
                var res = JSON.parse(result);
                if (res.success) {
                    alert('Data inserted');
                } else {
                    alert('something goes wrong:\n' + result.message);
                }
            },
            error: function (result) {
                alert('error');
            }
        });
    });
});