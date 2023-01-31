window.NewSelect = function (model, parent_id = null, level = 0, id = null,selected=false) {
    var json
    console.log(selected)
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
       if (selected){
            $("#"+model+"_level_"+level).append('<option disabled>- выбрать -</option>');
        } else {
            $("#"+model+"_level_"+level).append('<option disabled selected="selected">- выбрать -</option>');
        }

        $("#"+model+"_level_"+(level-1)).removeAttr('name')
        $.each(json, function(key, data)
            {
                if (parent_id==data['parent_id']) {
                    if ($.inArray(data['id'],selected)!== -1){
                        $("#"+model+"_level_"+level).append('<option value="'+data['id']+'" selected="selected">'+data['title']+'</option>');
                        NewSelect(model,data['id'],(level+1),data['id'],selected);

                    } else {

                        $("#"+model+"_level_"+level).append(new Option(data['title'], data['id']));

                    }

                }

            }
        );
        $("#"+model+"_level_"+(level-1)).attr('name',model+"_id")

    }


}
