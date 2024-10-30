<script language="JavaScript" type="text/javascript">
 /* Mscaras ER */
function mascaracdpsb(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascaracdpsb()",1)
}

function execmascaracdpsb(){
    v_obj.value=v_fun(v_obj.value)
}

function mnum(v){
    v=v.replace(/\D/g,"")                    
    return v
}

function mcep(v){
    v=v.replace(/\D/g,"")                    
    v=v.replace(/^(\d{5})(\d)/,"$1$2")         
    return v
}
function mcpf(v){
    v=v.replace(/\D/g,"")                    
    v=v.replace(/^(\d{5})(\d)/,"$1$2")         
    return v
}

function mdata(v){
    v=v.replace(/\D/g,"");                    
    v=v.replace(/(\d{2})(\d)/,"$1-$2");       
    v=v.replace(/(\d{2})(\d)/,"$1-$2");       
                                             
    v=v.replace(/(\d{2})(\d{2})$/,"$1$2");
    return v;
}

function mvalor(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/(\d)(\d{8})$/,"$1.$2");
    v=v.replace(/(\d)(\d{5})$/,"$1.$2");
        
    v=v.replace(/(\d)(\d{2})$/,"$1,$2");
    return v;
}
function mtel(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}

//-->
</script>