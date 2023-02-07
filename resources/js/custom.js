window.NewSelect = function (model, parent_id = null, level = 0, id = null,selected=false) {
    var json

    var child_cat = 0;
    if (model === 'rubric')   json =  json_rubric;
    if (model === 'location') json =  json_location;
    $.each(json, function(key, data)
        {
            if (parent_id==data['parent_id']) {
                child_cat++
            }
        }
    )
    $('#log').text("child_cat:"+child_cat+" parent_id:"+parent_id+" level:"+level)
    if(level>0 && child_cat===0) {$("#"+model+"_level_"+level).remove()}
    if (child_cat>0){
        var sel = $("#container_"+model+"_"+(level)).html("<select class=\"form-select\" name='"+model+"_id' id='"+model+"_level_"+level+"' onchange=\"NewSelect('"+model+"' ,this.value,"+(level+1)+","+parent_id+")\"></select>");
        $("#container_"+model+"_"+(level)).append($("<div id='container_"+model+"_"+(level+1)+"'></div>"))
        if (id){
            $("#"+model+"_level_"+level).append('<option disabled>- выбрать -</option>');
        }
    else {
            $("#"+model+"_level_"+level).append('<option disabled selected="selected">- выбрать -</option>');
        }

        $("#"+model+"_level_"+(level-1)).removeAttr('name')

        $.each(json, function(key, data)
            {
                if (parent_id==data['parent_id']) {
                        $("#"+model+"_level_"+level).append(new Option(data['title'], data['id']));
                }
            }
        );





    } else {
        if (model === 'rubric') Parameter_Rubric($("select[name='rubric_id']").val());
        $("#"+model+"_level_"+(level-1)).attr('name',model+"_id")
        $("#"+model+"_level_"+(level-1)).attr('required',"required")
    }

}

$(document).ready(function(){
    $('input[type="checkbox"]').change(function(e) {

        var checked = $(this).prop("checked"),
            container = $(this).parent(),
            siblings = container.siblings();

        container.find('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: checked
        });

        function checkSiblings(el) {

            var parent = el.parent().parent(),
                all = true;

            el.siblings().each(function() {
                let returnValue = all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
                return returnValue;
            });

            if (all && checked) {

                parent.children('input[type="checkbox"]').prop({
                    indeterminate: false,
                    checked: checked
                });

                checkSiblings(parent);

            } else if (all && !checked) {

                parent.children('input[type="checkbox"]').prop("checked", checked);
                parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
                checkSiblings(parent);

            } else {

                el.parents("li").children('input[type="checkbox"]').prop({
                    indeterminate: true,
                    checked: false
                });

            }

        }

        checkSiblings(container);

    });

})

window.CheckRubrics = function (parent_id,id) {
    console.log(id)
    var child_cat = $('.parent'+parent_id).length
    var child_cat_checked = $('.parent'+parent_id+':checked').length;

    if (child_cat>child_cat_checked) {
        $('#checkbox'+parent_id).prop({ indeterminate: true});

    }
    if (child_cat===child_cat_checked) {
        $('#checkbox'+parent_id).prop({ indeterminate: false,checked: true});

    }
    if (child_cat_checked===0) {
        $('#checkbox'+parent_id).prop({ indeterminate: false,checked: false});

    }
    if ($('.parent'+id).length>0){
        $(".parent"+id).each(function (){
            $(".parent"+$(this).val()).prop('checked', true);
            CheckRubrics(id,$(this).val());
        })
    }
}

window.Parameter_Rubric = function(rubric_id){
    $(".input-parameter").hide();


    $.each(json_parameter_rubric, function(key, data)
    {
        console.log(rubric_id+' '+data['parameter_id'])

        if (rubric_id==data['rubric_id']) {

            $('#parameter_'+data['parameter_id']).show()
        }
    })
}
