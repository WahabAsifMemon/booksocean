      $(document).on('click','.updatingStatus',function () {
        $this = $(this);
        var id = $(this).attr('id');
        var table = $(this).attr('table');
        var status = $(this).attr('status');
        $.ajax({
          url:`/admin/UpdateStatus`,
          type:'POST',
          data:{id:id,table:table,status:status},
          success:function (response) {
              if (response.status=="DEACTIVE") {
                $this.removeClass('btn-info');
                $this.addClass('btn-danger');
                $this.attr('status',response.status);
                $(`#icon_${id}`).removeClass('fa-thumbs-up');
                $(`#icon_${id}`).addClass('fa-thumbs-down');
                $.notify(
                  "Status Deactiveted Successfully", 'error'
                );
              }else if(response.status=="ACTIVE"){
                $this.attr('status',response.status);
                $this.removeClass('btn-danger');
                $this.addClass('btn-info');
                $(`#icon_${id}`).removeClass('fa-thumbs-down');
                $(`#icon_${id}`).addClass('fa-thumbs-up');
                $.notify(
                  "Status Activated Successfully", 'success'
                );
              }
          },
          error:function () {
            // alert(2);
            console.log(`Don't Be Over`)
          }
        })
      });
