$.ajax({
   url: "backend.php",
   type: "get",
   dataType: "json"
}).done( r => {
    console.log(r)
    var conversa = ''
    var sender = r.thread[0].message[0].sender;
    console.log('sender', sender)
   $.each( r.thread, function(i, j){
        conversa += '<p style="position:relative;padding-top: 57px"; >'+j.data+'</p>'
        $.each(j.message, function(a, b){    
            if( sender == b.sender ){
                console.log('sender')
                conversa += '<div class=" col-xs-12" style="width: 90%; float: left; background-color: yellow" >'+
                           '     <span>'+b.body+'</span>'+
                           '</div>' +
                           '<div class="row"></div>' 

            }else{
                conversa += '<div class="col-xs-5" style="width: 90%; float: right; background: red" >'+
                            '     <span>'+b.body+'</span>'+
                            '</div>'+
                            '<div class="row"></div>' 

            }
        })
        var mensagens = $('.mensagem')
        mensagens.empty().html( conversa )
   })   
})