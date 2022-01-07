
    
    <?php /* ?>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                               Blog
                            </a>
                        </li>
                        <li>
                            <a href="http://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                </div>
            </div>
        </footer>

    <?php */ ?>


	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=site_url().'assets/admin/'?>js/lib/jquery/jquery.min.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>jQueryvalidate/jquery.validate.min.js"></script>
    <script src="<?=site_url().'assets/admin/'?>js/lib/tether/tether.min.js"></script>
    <script src="<?=site_url().'assets/admin/'?>js/lib/bootstrap/bootstrap.min.js"></script>
    <script src="<?=site_url().'assets/admin/'?>js/plugins.js"></script>

    <script type="text/javascript" src="<?=site_url().'assets/admin/'?>js/lib/jqueryui/jquery-ui.min.js"></script>
    <?php /* ?>
    <!-- <script type="text/javascript" src="<?=site_url().'assets/admin/'?>js/lib/lobipanel/lobipanel.min.js"></script> -->
    <script type="text/javascript" src="<?=site_url().'assets/admin/'?>js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script src="<?=site_url().'assets/admin/'?>js/lib/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script >
         $('input.maxlength').maxlength({
            threshold: 10,
            warningClass: "label label-success",
            limitReachedClass: "label label-danger",
            separator: ' of ',
            preText: 'You have ',
            postText: ' chars remaining.',
            validate: true,
            //alwaysShow: true
        });
    </script>
    <?php */ ?>
    <?php if (isset($datepicker) && ($datepicker)) { ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( ".datepicker" ).datepicker({dateFormat:"yy-mm-dd"});
    } );
    </script>
    <?php } ?>
    <?php if (isset($tag_editor) && ($tag_editor)) { ?>
    <script src="<?=site_url().'assets/admin/'?>js/lib/jquery-tag-editor/jquery.tag-editor.min.js"></script>
    <script>
    $( function() {
        $( ".tag_editor" ).tagEditor();
    } );
    </script>
    <?php } ?>
    <?php /* if(isset($jqv_slug) && ($jqv_slug=='dashboard')){ ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>$(document).ready(function(){function o(){var o=new google.visualization.DataTable;o.addColumn("string","Day"),o.addColumn("number","Values"),o.addColumn({type:"string",role:"tooltip",p:{html:!0}}),o.addRows([["MON",130," "],["TUE",130,"130"],["WED",180,"180"],["THU",175,"175"],["FRI",200,"200"],["SAT",170,"170"],["SUN",250,"250"],["MON",220,"220"],["TUE",220," "]]);var t={height:314,legend:"none",areaOpacity:.18,axisTitlesPosition:"out",hAxis:{title:"",textStyle:{color:"#fff",fontName:"Proxima Nova",fontSize:11,bold:!0,italic:!1},textPosition:"out"},vAxis:{minValue:0,textPosition:"out",textStyle:{color:"#fff",fontName:"Proxima Nova",fontSize:11,bold:!0,italic:!1},baselineColor:"#16b4fc",ticks:[0,25,50,75,100,125,150,175,200,225,250,275,300,325,350],gridlines:{color:"#1ba0fc",count:15}},lineWidth:2,colors:["#fff"],curveType:"function",pointSize:5,pointShapeType:"circle",pointFillColor:"#f00",backgroundColor:{fill:"#008ffb",strokeWidth:0},chartArea:{left:0,top:0,width:"100%",height:"100%"},fontSize:11,fontName:"Proxima Nova",tooltip:{trigger:"selection",isHtml:!0}},e=new google.visualization.AreaChart(document.getElementById("chart_div"));e.draw(o,t)}$(".panel").lobiPanel({sortable:!0}),$(".panel").on("dragged.lobiPanel",function(o,t){$(".dahsboard-column").matchHeight()}),google.charts.load("current",{packages:["corechart"]}),google.charts.setOnLoadCallback(o),$(window).resize(function(){o(),setTimeout(function(){},1e3)})});</script>
    <?php } */?>
    <script src="<?=site_url().'assets/admin/'?>js/app.js"></script>

<?php /* if (isset($editor) && ($editor)) { ?>

    <!-- CKeditor Basic -->
    <!-- <script src="<?=site_url().'assets/'?>third_party/ckeditor-sd/ckeditor.js"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //CKEDITOR.replace( 'page_content' );
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.inline( 'page_content' );
    </script> -->
    <!-- / CKeditor Basic -->

    <!-- Sirtrevor -->
    <script src="<?=site_url().'assets/third_party/'?>trevor/underscore.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>trevor/eventable.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>trevor/sortable.min.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>trevor/sir-trevor.js"></script>
    <script src="<?=site_url().'assets/third_party/'?>trevor/sir-trevor-bootstrap.js"></script>
    <script type="text/javascript">
        
        new SirTrevor.Editor({ el: $('#page_content'),
        blockTypes: ["Columns", "Heading", "Text", "ImageExtended", "Quote", "Accordion", "Button", "List", "Iframe"]
        });
        SirTrevor.onBeforeSubmit();
    </script>
    <script type="text/javascript">
      function formSubmit(){
          SirTrevor.onBeforeSubmit();
          document.getElementById("contentForm").submit();
      }
    </script>
    <!-- /Sirtrevor -->

<?php } */ ?>
<?php if (isset($summernote_editor) && ($summernote_editor)) { ?>
    <script src="<?=site_url().'assets/third_party/'?>summernote/summernote.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.editor').summernote({height: 300});
        });
    </script>
<?php } ?>
<?php if (isset($tinymce_editor) && ($tinymce_editor)) { ?>
    <script src="<?=site_url().'assets/'?>third_party/tinymce/tinymce.min.js"></script>
    <script src="<?=site_url().'assets/'?>third_party/tinymce/jquery.tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
          selector: "textarea",
          image_class_list: [
            {title: 'img-responsive', value: 'img-responsive'}
          ],
          images_upload_url: '<?=base_url()?>admin/dashboard/upload_tinymce',
          image_advtab: true,
          plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste jbimages"
          ],
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
          // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
          //theme:'advanced',
          relative_urls: false
        });
    </script>
<?php } ?>
<?php if (isset($froala_editor) && ($froala_editor)) { ?>
  <!-- Include JS files. -->
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/froala_editor.min.js"></script>

  <!-- Include Code Mirror. -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

  <!-- Include Plugins. -->
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/align.min.js"></script>
  <!--   
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/char_counter.min.js"></script> -->
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/code_beautifier.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/code_view.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/colors.min.js"></script>
  <!--   
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/emoticons.min.js"></script> 
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/entities.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/file.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/font_family.min.js"></script> 
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/font_size.min.js"></script>
  -->
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/fullscreen.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/image.min.js"></script>
  <!--   <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/image_manager.min.js"></script> 
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/inline_style.min.js"></script>
  -->
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/line_breaker.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/link.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/lists.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/paragraph_format.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/paragraph_style.min.js"></script>
  <!--   <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/quick_insert.min.js"></script> -->
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/quote.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/table.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/save.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/url.min.js"></script>
  <script type="text/javascript" src="<?=site_url().'assets/third_party/'?>froala_editor_2.3.5/js/plugins/video.min.js"></script>

  <!-- Initialize the editor. -->
  <script>
      $(function() {
          $('.editor').froalaEditor({
            imageUploadURL: '<?=base_url()?>/admin/dashboard/upload_froala',
            imageUploadParams: {
                id: 'my_editor'
            }
          })
      });
  </script>
<?php } ?>

<?php if(isset($jqv_slug) && ($jqv_slug=='site_settings_information')){ ?>
<?php } ?>

<?php if(isset($jqv_slug) && ($jqv_slug=='add_page')){ ?>
    <script type="text/javascript">
    	var HOST = '<?=base_url()?>';
    	$(function(){
    		$('.form').validate({
    			rules:{ 
          page_title:{required:true},
          page_subtitle:{required:true},
					page_slug:{required:true,remote:{url: HOST+'admin/pages/validate_slug',type: "post",data:{page_slug: function(){return $('form :input[name="page_slug"]').val();}}}},
					meta_title:{required:true,maxlength: 60},
					meta_keywords:{required:true,maxlength: 255},
					meta_description:{required:true,maxlength: 160},
					active:{required:true}
    			},
    			messages:{
          page_title:{required:"This field is required."},
          page_subtitle:{required:"This field is required."},
					page_slug:{required:"This field is required.",remote:"This slug is already taken." },
          meta_title:{required:"This field is required.",maxlength:" Maximum 66 characters are allowed"},
					meta_keywords:{required:"This field is required.",maxlength:" Maximum 255 characters are allowed"},
					meta_description:{required:"This field is required.",maxlength:" Maximum 160 characters are allowed"},
					active:{required:"This field is required."}
    			},
                submitHandler: function(form) {form.submit();}
    		});
    	});
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='edit_page')){ ?>
    <script type="text/javascript">
      var HOST = '<?=base_url()?>';
      $(function(){
        $('.form').validate({
          rules:{
            page_title:{required:true},
            page_subtitle:{required:true},
          <?php if($page_data['fixed']=='0') { ?>
          page_slug:{required:true,
            remote:{url: HOST+'admin/pages/validate_slug',type: "post",data:{
              initial:function(){return $('form :input[name="page_slug_initial"]').val();},
              page_slug: function(){return $('form :input[name="page_slug"]').val();}}}},
          <?php } ?>
          meta_title:{required:true},
          meta_keywords:{required:true},
          meta_description:{required:true},
          active:{required:true}
          },
          messages:{
            page_title:{required:"This field is required."},
            page_subtitle:{required:"This field is required."},
                    <?php if($page_data['fixed']=='0') { ?>
                    page_slug:{
                        required:"This field is required.",
                        remote:"This SLUG is already taken."
                    },
                    <?php } ?>
          meta_title:{required:"This field is required."},
          meta_keywords:{ required:"This field is required." },
          meta_description:{ required:"This field is required." },
          active:{ required:"This field is required."}
          },
          submitHandler: function(form) {
              form.submit();
          }
        });
      });
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='edit_opengraph')){ ?>
    <script type="text/javascript">
    	var HOST = '<?=base_url()?>';
    	$(function(){
    		$('.form').validate({
    			rules:{
            og_title:{required:true},
            og_type:{required:true},
            og_description:{required:true},
            tw_title:{required:true},
            tw_card:{required:true},
            tw_description:{required:true}
    			},
          submitHandler: function(form) {
              form.submit();
          }
    		});
    	});
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_pages')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/pages/delete_page',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>

<?php if(isset($jqv_slug) && ($jqv_slug=='add_menu')){ ?>
  <script type="text/javascript">
	    function delete_data(table,id){
	    var strconfirm = confirm("Are you sure you want to delete?");
	    var HOST= '<?=base_url()?>';
	      if (strconfirm == true)
	      {
	        $.post(HOST+'admin/menu/delete_menu',{table:table,id:id},function(data){
	          if(data=='success'){
	            window.location=window.location;
	          }else{
	            alert(data);
	          }
	        });
	      }
	    }
	</script>
  <script type="text/javascript">
    	var HOST = '<?=base_url()?>';
    	$(function(){
    		$('form').validate({
    			rules:{
    				label:{
    					required:true
    				},
    				parent:{
    					required:true
    				},
    				sort:{
    					required:true
    				}
    			},
    			messages:{
    				label:{
    					required:"This field is required."
    				},
    				parent:{
    					required:"This field is required."
    				},
    				sort:{
    					required:"This field is required."
    				}
    			},
                submitHandler: function(form) {
                    form.submit();
                }
    		});
    	});
  </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='edit_menu')){ ?> 
    <script type="text/javascript">
    	var HOST = '<?=base_url()?>';
    	$(function(){
    		$('form').validate({
    			rules:{
    				label:{
    					required:true
    				},
    				parent:{
    					required:true
    				},
    				sort:{
    					required:true
    				}
    			},
    			messages:{
    				label:{
    					required:"This field is required."
    				},
    				parent:{
    					required:"This field is required."
    				},
    				sort:{
    					required:"This field is required."
    				}
    			},
                submitHandler: function(form) {
                    form.submit();
                }
    		});
    	});
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='add_user')){ ?>
    <script type="text/javascript">
    	var HOST = '<?=base_url()?>';
    	$(function(){
    		$('form').validate({
    			rules:{
    				email:{
    					required:true,
              remote:{
                    url: HOST+'admin/users/validate_user',
                    type: "post",
                    data:{
                        email: function(){
                            return $('form :input[name="email"]').val();
                        }
                    }
              }
    				},
    				name:{
    					required:true
    				},
    				group:{
    					required:true
    				}
    			},
    			messages:{
    				email:{
              required:"This field is required.",
    					remote:"This email is already registered."
    				},
    				name:{
    					required:"This field is required."
    				},
    				group:{
    					required:"This field is required."
    				}
    			},
          submitHandler: function(form) {
              form.submit();
          }
    		});
    	});
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='edit_user')){ ?>
    <script type="text/javascript">
    	var HOST = '<?=base_url()?>';
    	$(function(){
    		$('form').validate({
    			rules:{
    				email:{
    					required:true
    				},
    				name:{
    					required:true
    				},
    				password:{
    					required:true
    				},
    				group:{
    					required:true
    				}
    			},
    			messages:{
    				email:{
    					required:"This field is required."
    				},
    				name:{
    					required:"This field is required."
    				},
    				password:{
    					required:"This field is required."
    				},
    				group:{
    					required:"This field is required."
    				}
    			},
                submitHandler: function(form) {
                    form.submit();
                }
    		});
    	});
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_users')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/users/delete_user',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='add_blog')){ ?>
    <script type="text/javascript">
        var HOST = '<?=base_url()?>';
        $(function(){
            $('.form').validate({
                rules:{
                    blog_category_slug:{required:true},
                    date:{required:true},
                    blog_title:{required:true},
                    blog_slug:{required:true,
                      remote:{
                            url: HOST+'admin/blog/validate_slug_blog',
                            type: "post",
                            data:{
                                blog_slug: function(){
                                    return $('form :input[name="blog_slug"]').val();
                                }
                            }
                      }
                    },
                    blog_seo_title:{required:true},
                    blog_seo_keywords:{required:true},
                    blog_seo_description:{required:true},
                    blog_content:{required:true},
                    active:{required:true},
                    tags:{required:true}
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $('input[name=blog_title]').keyup(function(){
                var text = $('input[name=blog_title]').val();
                text = text.replace(/ /g, '-');
                text = text.toLowerCase();
                $('input[name=blog_slug]').val(text);
            });
        });
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='edit_blog')){ ?>
    <script type="text/javascript">
        var HOST = '<?=base_url()?>';
        $(function(){
            $('.form').validate({
                rules:{
                    blog_category_slug:{required:true},
                    date:{required:true},
                    blog_title:{required:true},
                    blog_slug:{required:true,
                      remote:{
                            url: HOST+'admin/blog/validate_slug_blog',
                            type: "post",
                            data:{
                                blog_slug_initial: function(){
                                    return $('form :input[name="blog_slug_initial"]').val();
                                },
                                blog_slug: function(){
                                    return $('form :input[name="blog_slug"]').val();
                                }
                            }
                      }
                    },
                    blog_seo_title:{required:true},
                    blog_seo_keywords:{required:true},
                    blog_seo_description:{required:true},
                    blog_content:{required:true},
                    active:{required:true},
                    tags:{required:true}
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_blog')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/blog/delete_blog',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='add_blog_category')){ ?>
    <script type="text/javascript">
        var HOST = '<?=base_url()?>';
        $(function(){
            $('.form').validate({
                rules:{
                    blog_category_title:{required:true},
                    blog_category_slug:{required:true,
                      remote:{
                            url: HOST+'admin/blog/validate_slug_blog_category',
                            type: "post",
                            data:{
                                blog_category_slug: function(){
                                    return $('form :input[name="blog_category_slug"]').val();
                                }
                            }
                      }
                    },
                    blog_category_description:{required:true},
                    blog_category_seo_title:{required:true},
                    blog_category_seo_keywords:{required:true},
                    blog_category_seo_description:{required:true}
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $('input[name=blog_category_title]').keyup(function(){
                var text = $('input[name=blog_category_title]').val();
                text = text.replace(/ /g, '-');
                text = text.toLowerCase();
                $('input[name=blog_category_slug]').val(text);
            });
        });
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='edit_blog_catgeory')){ ?>
    <script type="text/javascript">
        var HOST = '<?=base_url()?>';
        $(function(){
            $('.form').validate({
                rules:{
                    blog_category_title:{required:true},
                    //blog_category_slug:{required:true},
                    blog_category_description:{required:true},
                    blog_category_seo_title:{required:true},
                    blog_category_seo_keywords:{required:true},
                    blog_category_seo_description:{required:true}
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_blog_catgeory')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/blog/delete_blog_catgeory',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_photos')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/photos/delete_photos',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='add_photo_slider')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/slider/delete_photos',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='add_video')){ ?>
    <script type="text/javascript">
        jQuery(function() {
          var youtubePattern = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;

          jQuery.validator.addMethod("youtubeVideo", function(value) {
            return youtubePattern.test(value);
          }, "Must be a valid Youtube video");
        });
        $(function(){
            $('#video_link').keyup(function(){
               var video_link = $('#video_link').val();
            if (youtube_parser(video_link)) {
                $('#video_link').parent().removeClass('has-error');
                $('#video_link').parent().addClass('has-success');
                var video_hash = youtube_parser(video_link);
                $('#video_hash').val(video_hash);
                $('#form_submit').removeClass('disabled');
                $('#img_preview').attr('src','http://img.youtube.com/vi/'+video_hash+'/0.jpg');
            } else {
                $('#video_link').parent().removeClass('has-success');
                $('#video_link').parent().addClass('has-error');
                $('#video_hash').val('');
                $('#form_submit').addClass('disabled');
                $('#img_preview').attr('src','<?=base_url()?>assets/admin/img/300x200.png');
            } 
            });
            $('.form').validate({
              rules:{
                video_link:{required:true,youtubeVideo:true},
                video_hash:{required:true},
                video_title:{required:true},
                video_description:{required:true}
              },
              submitHandler: function(form) {
                  form.submit();
              }
            });
        });
        function youtube_parser(url){
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            return (match&&match[7].length==11)? match[7] : false;
        }
    </script>
<?php }?>
<?php if(isset($jqv_slug) && ($jqv_slug=='edit_video')){ ?>
    <script type="text/javascript">
        jQuery(function() {
          var youtubePattern = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;

          jQuery.validator.addMethod("youtubeVideo", function(value) {
            return youtubePattern.test(value);
          }, "Must be a valid Youtube video");
        });
        $(function(){
            video_preview();
            $('#video_link').keyup(video_preview);
            $('.form').validate({
              rules:{
                video_link:{required:true,youtubeVideo:true},
                video_hash:{required:true},
                video_title:{required:true},
                video_description:{required:true}
              },
              submitHandler: function(form) {
                  form.submit();
              }
            });
        });
        function video_preview(){
            var video_link = $('#video_link').val();
            if (youtube_parser(video_link)) {
                $('#video_link').parent().removeClass('has-error');
                $('#video_link').parent().addClass('has-success');
                var video_hash = youtube_parser(video_link);
                $('#video_hash').val(video_hash);
                $('#form_submit').removeClass('disabled');
                $('#img_preview').attr('src','http://img.youtube.com/vi/'+video_hash+'/0.jpg');
            } else {
                $('#video_link').parent().removeClass('has-success');
                $('#video_link').parent().addClass('has-error');
                $('#video_hash').val('');
                $('#form_submit').addClass('disabled');
                $('#img_preview').attr('src','<?=base_url()?>assets/admin/img/300x200.png');
            }
        }
        function youtube_parser(url){
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            return (match&&match[7].length==11)? match[7] : false;
        }
    </script>
<?php }?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_videos')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/videos/delete_videos',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_project_photos')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/projects/delete_photo',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_projects')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/projects/delete_project',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_team_member')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/team/delete_team_member',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>
<?php if(isset($jqv_slug) && ($jqv_slug=='all_contacts')){ ?>
    <script type="text/javascript">
      function delete_data(table,id){
        var strconfirm = confirm("Are you sure you want to delete?");
        var HOST= '<?=base_url()?>';
          if (strconfirm == true)
          {
            $.post(HOST+'admin/contact/delete_contact',{table:table,id:id},function(data){
              if(data=='success'){
                window.location=window.location;
              }else{
                alert(data);
              }
            });
          }
        }
    </script>
<?php } ?>

<?php if(isset($cropping_ratio)){ ?>
    <script src="<?=site_url().'assets/'?>third_party/jQueryForm/jquery.form.min.js"></script>
    <script src="<?=site_url().'assets/'?>third_party/cropper/cropper.min.js"></script>
    <script type="text/javascript">
        function updateCoords(c){jQuery('#x').val(c.x);jQuery('#y').val(c.y);jQuery('#w').val(c.width);jQuery('#h').val(c.height);};

        function checkCoords(){if(parseInt(jQuery('#w').val())>0) return true;alert('Please select a crop region then press submit.');return false;};

        (function() {
        $('#imageform').ajaxForm({
          beforeSubmit: function() {count = 0;val = $.trim( $('#images').val() );if( val == '' ){count= 1;$( "#images" ).next('span').html( "Please select your images" );} if(count == 0){for (var i = 0; i < $('#images').get(0).files.length; ++i) { img = $('#images').get(0).files[i].name; var extension = img.split('.').pop().toUpperCase(); if(extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){count= count+ 1} } if( count> 0) $( "#images" ).next('span').html( "Please select valid images" );}if( count> 0){ return false; } else {$( "#images" ).next('span').html( "" );}},
          
          beforeSend:function(){ $('#loader').show();$('#image_upload').hide();},
          success: function(msg) {},
          complete: function(xhr) {$('#loader').hide();$('#image_upload').show();$('#images').val('');$('#error_div').html('');result = xhr.responseText; result = $.parseJSON(result);
              base_path = '<?=base_url()?>';
            if( result.success ){ name = base_path+'uploads/cache/'+result.success;
                  /*html = '';
                  html+= '<image id="cropbox" class="img-responsive" src="'+name+'">';
                  $('#uploaded_images #success_div').append( html );*/
                  $('#cropbox').attr('src',name);$('#orignal_path').val(name);$('#file_name').val(result.success);
                  //jcrop
                  jQuery('#cropbox').cropper({
                      aspectRatio: <?=$cropping_ratio?>,
                      move: updateCoords,
                      crop: updateCoords,
                      preview: '#preview1'
                  });

              } else if( result.error ){
                  error = result.error
                  html = '';
                  html+='<p>'+error+'</p>';
                  $('#uploaded_images #error_div').append( html );
              }
              $('#error_div').delay(5000).fadeOut('slow'); }});  })();  
    </script>
<?php }?>


  </body>
</html>