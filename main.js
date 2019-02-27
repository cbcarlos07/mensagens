$.ajax({
   url: "backend.php",
   type: "get",
   dataType: "json"
}).done( r => {
    console.log(r)
   $.each( r.thread, function(i, j){
        console.log('data', j.data)
        $.each(r, function(a, b){
            console.log('message', b)
        })
   })
})