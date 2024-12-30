var alert_success="alert alert-success alert-dismissible";
var alert_waring="alert alert-warning alert-dismissible";
var alert_info="alert alert-info alert-dismissible";
var alert_danger="alert bg-red alert-dismissible";


function Trush(table){
    
    if(confirm("Are you sure you want to delete marked rows")){

}else{
return false;
}
    
    
    
       var allVals = [];
       var allVals= $('input[name=mycheck]:checked').map(function()
            {
                return $(this).val();
            }).get();
       var elements=allVals.length;
       
       if(elements>0){
              $.ajax({
                        type: "POST",
                        data: {all:allVals,table:table},
                        url: "ajex/master-del.php",
                        success: function(msg){  
                            
                            $("input[name='mycheck']:checkbox").prop('checked',false);
                            $('#checkAll').prop('checked',false);
                            
                            Msg("selected rows deleted",alert_success);
                            for(var i=0;i<allVals.length;i++){
                                $('#row'+allVals[i]).remove();
                            }
                        }
                    });
                }else{
                    Msg("Please select at least one row",alert_danger);
                }
            
            
            
            
            
}

function Edit(){
    
}


function Msg(text,event){
    $('#msg_box').text(text);
    $('#msg').addClass(event);
    $('#msg').removeClass("hidden");
}
function hide(){
    $('#msg').addClass("hidden");
}


$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});



