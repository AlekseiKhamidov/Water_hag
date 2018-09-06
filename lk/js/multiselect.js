function tableFilter(data){
       var ths = $table.find("th.excel-filter");
    //      $(filterContainer).empty();
       for (var i = 0; i < ths.length; i++) {
         var column = $(ths[i]).attr("data-field");
         var formatterValue = $(ths[i]).data().searchFormatter== undefined ? undefined:window[$(ths[i]).data().searchFormatter];//window[$(ths[i]).data().formatter]
         //var dopValue

         var id = "filter-"+column;
    //     addIcon($(ths[i]).find(".th-inner "));
         addIcon($(ths[i]).find(".fht-cell"), column);

         createUl(id,data,column, formatterValue);
       }


       function addIcon($parent, column){

         var div = document.createElement('div');
          div.className = 'btn-group';

         var button = document.createElement('a');
         button.setAttribute('onclick', 'openDropdown(this)');

         button.className =  "icons-sm fb-ic";
         button.setAttribute("type","button");

         var i= document.createElement('i');
         i.className = "fa fa-filter";

         button.appendChild(i);
         div.appendChild(button);

         $parent.append('<button class="custom-select" onclick="openDropdown(this)"  column-name="'+column+'" type="button"></button>')
       //  $parent.append(div);
       }

      // createUl(id);

       function createUl(id, data, column, formatter){
         var resultObject = {};
         $("#"+id).empty();
         if ($("#"+id).length==0){
           var div = '<div id="'+id+'" isActive="false" column-name="'+column+'" tabindex="-1" class="dropdown-menu" x-placement="bottom-end" style="display:none; position: absolute; transform: translate3d(0px, 35px, 0px);  will-change: transform; overflow:auto">'
             +' <div class="dropdown-filter-search"><input type="text" class="dropdown-filter-menu-search form-control" data-column="4" data-index="0" placeholder="Поиск"></div>'
             +' <label class="dropdown-item"><input type="checkbox" value="Select All" class="select_all" checked="checked" >Выбрать все'
             +' <div class="dropdown-divider"></div>'
             +'</label></div>';
           $(filterContainer).append(div);

         }
         else {
           var search = ' <div class="dropdown-filter-search"><input type="text" class="dropdown-filter-menu-search form-control" data-column="4" data-index="0" placeholder="Поиск"></div>'
              +' <label class="dropdown-item"><input type="checkbox" value="Select All" class="select_all" checked="checked" >Выбрать все'
              +' <div class="dropdown-divider"></div>'
              +'</label>';
           $("#"+id).append(search)
         }
         var format = function(elem){return elem.trim();};
         if (column == "status"){
           format = function(elem){
             return parseStatus(elem).sorter;
           }
         }
            resultObject = searchArray(column, data, format);
         for (var i=0;i<Object.keys(resultObject).length;i++){

           var elem = Object.keys(resultObject)[i];
           var dopValue = elem;
           if (formatter) elem = formatter(elem);
           addOption($(filterContainer).find('#'+id), elem,dopValue);
         }


    //      resultObject = searchArray(column, data);


            var text = Object.keys(resultObject).length>0? "Выбрано "+Object.keys(resultObject).length: "";

         $('.table.table-hover [column-name="'+column+'"]').each(function(){
           $(this).text(text)
         })

            setHeightFilter($("#"+id))
       }


       function setHeightFilter($div){
         var height = $div.height();
         if (height>$(window).height()*0.8 )
       $div.height($(window).height()*0.6);
       }


       function searchArray(nameKey, myArray, format){
         var result = {};
         myArray.sort(function(a,b){
           var a = format(a[nameKey]);
           var b = format(b[nameKey]);
           if (typeof(a) == "string" && typeof(b) == "string"){
              return format(a).localeCompare(format(b));
           }
           if (typeof(a) == "number" && typeof(b) == "number"){
            return a-b;
           }

            //return parseStatus(a[nameKey]).sorter.localeCompare(parseStatus(b[nameKey]).sorter)
        })
         for (var i=0; i < myArray.length; i++) {
           result[myArray[i][nameKey]] = i;
         }
         return result
        }
       function addOption($parent, elem, dopValue){
         function guid() {
             var S4 = function() {
                return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
             };
             return S4()+S4()+"-"+S4();
         }
       //  var guid = elem ;
         elem=elem ==""? "Пусто": elem;
   //      dopValue = dopValue? dopValue: "Пусто"

       //  dopValue = dopValue? dopValue:elem;
       var id=guid();

         var label ='<label class="dropdown-item" for="'+id+'"><input type="checkbox" id="'+id+'" data-field="name" value=\''+dopValue+'\' checked="checked"> '+elem+'</label>';
          $parent.append(label);
       //  parent.appendChild();
       }
     };
     function openDropdown(a){

        var column = $(a).parents("th").attr("data-field");
         var id = "#filter-"+column;

        var position = $(a).offset();
        $(id).css(position);
        $(id).show();

         $(id).focus();


        $(id).mouseenter(function(){
          $(this).attr("isActive", "true" )

         }).mouseleave(function(){
           $(this).attr("isActive", "false" )
      });

         $("body").mousedown(function(){
          //$('#dropdownName:visible').focusout(function() {
          if ($(id).attr("isActive") == "false"){
            $(id).hide();
          }
         })

         $(".dropdown-filter-search [type='text']").unbind("keyup").keyup(function(e) {
          console.log($(this).val());
          var searchText = $(this).val();

          $(this).parents(".dropdown-menu").find("[type='checkbox']:not(.select_all)").filter(function( index ) {
   // return index === 1 || $( this ).attr( "id" ) === "fourth";
  // return  $( this ).attr("value").indexOf(searchText);
        if  ($( this ).attr("value").toLowerCase().indexOf(searchText.toLowerCase())>-1){
           $( this ).parent().show();
          // $(this).prop("checked", true)
        }
        else {
                $( this ).parent().hide()
            //    $(this).prop("checked", false)
              }

       })

   //       applyFilterBy( $( this ).parents(".dropdown-menu").attr("column-name"))
         });

         $('.dropdown-menu [type="checkbox"].select_all').unbind("change").change(function(e) {
            $(this).parents("div.dropdown-menu").find("[type='checkbox']:not(.select_all)").prop("checked",$(this).prop("checked"))
             applyFilterBy($(this).parents("div.dropdown-menu").attr("column-name"));
          });

          $('.dropdown-menu [type="checkbox"]:not(.select_all)').unbind("change").change(function(e) {
            if ($(this).prop("checked")){
              var countAll = $(this).parents("div.dropdown-menu").find("[type='checkbox']:not(.select_all)").length;
              var countChecked = $(this).parents("div.dropdown-menu").find("[type='checkbox']:checked:not(.select_all)").length;
              if (countChecked == countAll) {
                $(this).parents("div.dropdown-menu").find("[type='checkbox'].select_all").prop("checked",true);
              }
            }
            else{
              $(this).parents("div.dropdown-menu").find("[type='checkbox'].select_all").prop("checked",false);
            }
            applyFilterBy($(this).parents("div.dropdown-menu").attr("column-name"));
          });

          function applyFilterBy(column){
            var filter = {};
            var dropdowns = $(filterContainer+" .dropdown-menu");
            for (var i=0;i<dropdowns.length;i++){
              var mas = $(dropdowns[i]).find("[type='checkbox']:checked:not(.select_all)").map(function() {
              //  return this.value=="Пусто"? "": this.value;
              return this.value;
              }).toArray();
              var columnName = $(dropdowns[i]).attr("column-name");
              filter[columnName] = mas;
            }
            $table.bootstrapTable('filterBy', filter);
            Data = $table.bootstrapTable('getData');
            var text = filter[column].length>0? "Выбрано "+filter[column].length: "";

          $('.table.table-hover [column-name="'+column+'"]').each(function(){
            $(this).text(text)
          })
          $table.bootstrapTable('resetView');

          }

      }
