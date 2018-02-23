
console.log("sdesf");
$(document).ready(function(){
        var response = '';
        $.ajax({ type: "POST",   
                 url: "http://10.10.2.91/copy/get.php",   
                 async: false,
                 success : function(text)
                 {
                     response = text;
                     console.log(response);
                 }
        });
        var data= JSON.parse(response);
        console.log(data)
        for(let i=1;i<=Object.keys(data).length;i++){
          add_data(data[i]['phone'],data[i]['name'],data[i]['email']);
        }
        alert(response);
        });
      $(function () {

        $('#form').on('submit', function (e) {
          var response='';
          e.preventDefault();
            console.log($('form').serialize())
          $.ajax({
            type: 'post',
            url: 'http://10.10.2.91/copy/save.php',
            data: $('form').serialize(),
            success: function (text) {
              response = text;
              alert('form was submitted');
              console.log(response)
            }
          });

           let phone=document.getElementById('phone').value;
           let name=document.getElementById('name').value;
           let email=document.getElementById('email').value;
           add_data(phone,name,email);
        });
        $('#form1').on('submit', function (e) {
          e.preventDefault();
          checkbox_call(2);
        });

      });
      //       $(function (e) {
      //         e.preventDefault();
        

      // });
      function add_data(phone,name,email){
        console.log(phone+' '+name+' '+email)
      var tr=document.createElement("tr");
      var td1=document.createElement("td");
      td1.textContent=phone;
      var td2=document.createElement("td");
      td2.textContent=name;
      var td3=document.createElement("td");
      td3.textContent=email;
      var td4=document.createElement("input");
      td4.setAttribute("type", "checkbox");
      tr.appendChild(td4);
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      document.getElementById("main_table").appendChild(tr);
      console.log("done");
    }
    function delete_data(id){
        //var id=this.parentNode.childNodes[0].textContent;
        for(var i=0;i<id.length;i++){

        console.log(id);
        
                  $.ajax({
            type: 'POST',
            url: 'http://10.10.2.91/copy/deletedata.php',
            data: {phone:id[i].childNodes[1].textContent},
            success: function () {
              
            }
          });
          id[i].parentNode.removeChild(id[i]);
    }
  }
    function update_data(id,name,email){
        //var id=this.parentNode.childNodes[0].textContent;
        console.log(id);
        
                  $.ajax({
            type: 'POST',
            url: 'http://10.10.2.91/copy/updatedata.php',
            data: {phone:id.childNodes[1].textContent,name:name,email:email},
            success: function (text) {
              console.log(text);
            }
          });
          id.childNodes[2].textContent=name;
          id.childNodes[3].textContent=email;     
    }
    function checkbox_call(id){
      let table=document.getElementById("main_table");
      var len=table.childNodes.length;
      var array=[];
      for(let i=2;i<len;i++){
        if(table.childNodes[i].childNodes[0].checked==true){
          console.log(table.childNodes[i].childNodes[3].textContent);
          if(id==1){
          array.push(table.childNodes[i]);
        }else{
           let name=document.getElementById('name1').value;
           let email=document.getElementById('email1').value;
          update_data(table.childNodes[i],name,email);
        }
        }
      }
      if(id==1)
      delete_data(array);

    }
    function check_all(){
      let table=document.getElementById("main_table");
      var len=table.childNodes.length;
      for(let i=2;i<len;i++){
        if(table.childNodes[i].childNodes[0].checked==true){
          table.childNodes[i].childNodes[0].checked=false;
        }else{
          table.childNodes[i].childNodes[0].checked=true;
        }
      }
    }

    /*
 document.getElementById("myDIV").childNodes.length
 checkBox.checked == true
    */