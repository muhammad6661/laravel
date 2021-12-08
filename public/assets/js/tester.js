 //Bot regex
 $(document).on('click','#submit_rejex',function(){
    $('.card-body #FIO_regex').each(function(){
     console.log($(this).val());
      id=$(this).attr('data-id');
      slug=translit($(this).val());
      fio_lation=transliter($(this).val());
      form_data=new FormData();
      form_data.append('id',id);
      form_data.append('slug',slug);
      form_data.append('latin_title',fio_lation);

      ajaxReq('/admin/regex/fio/'+id,'Post',(data)=>{
        console.log(id,slug,fio_lation);
      },form_data);
    });
  });

 $(document).on('keyup','.card-body #form_organization #title',function(e){
     e.preventDefault();
     $('.card-body #form_organization #slug').val(translit($(this).val()));
 });

//Store organization

$(document).on('click','#submit_organization',function(){
    $(this).html('Отправка...');
   title=$('#add_modal_ministry #title').val();
   if(title==""){
    $('#add_modal_ministry #error').html(printError('Введите заголовок'));
    $(this).html('Добавить');
    return ;
   }
   user_id=$('#add_modal_ministry #user_id').val();
   slug=translit(title);
   latin_title=transliter(title);
   href=window.location.pathname;
   rotue=href.split('/');
   form_data=new FormData();
   form_data.append('title',title);
   form_data.append('latin_title',latin_title);
   form_data.append('slug',slug);
   form_data.append('user_id',user_id);
   form_data.append('category_id',rotue[3]);
   ajaxReq('/admin/organization/store','Post',(data)=>{
      location.reload();
},form_data);
});
//Edit ministry
$(document).on('click','#edit_organization',function(e){
  e.preventDefault();
  id=$(this).attr('data-id');
  ajaxReq('/admin/organization/edit/'+id,'Get',(data)=>{
      $('#modal_ministry #myLargeModalLabel').html('Обнoвить oраганизация');
    $('#modal_ministry .modal-body .card-body').html(data.html);
    $('#modal_ministry').modal('show');
  });
});
//Update Ministry
$(document).on('click','#update_organization',function(){
    $(this).html('Отправка...');
   title=$('#modal_ministry #title').val();
   if(title==""){
    $('#modal_ministry #error').html(printError('Введите заголовок* (RU)'));
    $(this).html('Сохранить');
    return ;
   }
   user_id=$('#modal_ministry #user_id').val();
   slug=translit(title);
   latin_title=transliter(title);
   href=window.location.pathname;
   rotue=href.split('/');
   form_data=new FormData();
   form_data.append('title',title);
   form_data.append('latin_title',latin_title);
   form_data.append('slug',slug);
   form_data.append('user_id',user_id);

   ajaxReq('/admin/organization/update/'+id,'Post',(data)=>{
      location.reload();
},form_data);
});


//ADD organization in Shareholders
$(document).on('click','#submit_organization_share',function(){
    $(this).html('Отправка...');
   title=$('#add_modal_share #title').val();
   category_id=$('#category_id').val();
   if(title==""){
    $('#add_modal_share #error').html(printError('Введите заголовок* (RU)'));
    $(this).html('Добавить');
    return ;
   }
   if(category_id==""){
    $('#add_modal_share #error').html(printError('Выберите категория'));
    $(this).html('Добавить');
    return ;
   }
   user_id=$('#add_modal_share #user_id').val();
   slug=translit(title)
   latin_title=transliter(title);
   form_data=new FormData();
   form_data.append('title',title);
   form_data.append('slug',slug);
   form_data.append('latin_title',latin_title);
   form_data.append('category_id',category_id);
   form_data.append('user_id',user_id);
   ajaxReq('/admin/shareholder/organization/store','Post',(data)=>{
    $(this).html('Добавить');
      if(data.err==0){
          $("#organization").append('<option value="'+data.id+'" selected>'+data.title+'</option>');
          $('#add_modal_share').modal('hide');
          $('#add_modal_share #title').val('');
      }
},form_data);
});

//change category organiztions

$(document).on('change','#category_id',function(){
    id=$(this).val()!="" ? $(this).val() : -1;
    ajaxReq('/admin/shareholders/change/category/'+id,'Get',(data)=>{
       $('#organization').html(data.html);
    });
})

//Filte category in index shareholders
$(document).on('change','#filter_category',function(){
   ajaxReq('/admin/shareholder/filter/category/'+$(this).val(),'Get',(data)=>{
       location.reload();
   });
});

//Filte ministry in index shareholders
$(document).on('change','#filter_ministry',function(){
    console.log($(this).val());
   ajaxReq('/admin/shareholder/filter/ministry/'+$(this).val(),'Get',(data)=>{
       location.reload();
   });
});

//Get Value in typing
 $('#FIO_shareholder').keyup(function(event){
     console.log($(this).val(),"OKK");
    $('.card-body #slug').val(translit($(this).val()));
    $('.card-body #fio_latin').val(transliter($(this).val()));
 });


