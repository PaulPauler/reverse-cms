<script src="{{ asset('cms/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('cms/js/popper.min.js') }}"></script>
<script src="{{ asset('cms/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('cms/js/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('cms/js/jquery-sortable-min.js') }}"></script>
<script>
  $(document).ready(function() {
    var pg_id = -1;
    $('#save-event').on('click',function(evt){
      $('#page_id').val(pg_id);
      $('#delete_page_form').submit();
    });

    deletePageOpen = function(page_id){
      pg_id = page_id;
      $("#deletePage").modal();
    }

    /*Menu sortable*/
    $(function  () {
      var group = $("ol.cms-menu").sortable({
        group: 'cms-menu',
        pullPlaceholder: false,
        delay: 200,
        // animation on drop

        onMousedown: function ($item, _super, event) {
        if (!event.target.nodeName.match(/^(input|select|textarea)$/i) && $item.attr('data-drag') != 'false') {
            event.preventDefault();
            return true;
          }
        },

        onDrop: function  ($item, container, _super) {

          var data = group.sortable("serialize").get();
          var jsonString = JSON.stringify(data, null, ' ');
          var $clonedItem = $('<li/>').css({height: 0});
          $item.before($clonedItem);
          $clonedItem.animate({'height': $item.height()});

          $item.animate($clonedItem.position(), function  () {
            $clonedItem.detach();
            _super($item, container);
          });
          $.ajax({
              type: 'POST',
              url: '{{URL::to(env('CMS_URL', 'panel'))}}/pages/sortable',
              data: { '_token' : '{{csrf_token()}}', 'sortArray' : jsonString }
              // success: function(result){
              //     console.log(result);
              // }
          });
        },

        // set $item relative to cursor position
        onDragStart: function ($item, container, _super) {
          var offset = $item.offset(),
              pointer = container.rootGroup.pointer;

          adjustment = {
            left: pointer.left - offset.left,
            top: pointer.top - offset.top
          };

          _super($item, container);
        },
        onDrag: function ($item, position) {
          $item.css({
            left: position.left - adjustment.left,
            top: position.top - adjustment.top
          });
        }
      });
    });
  });
</script>

<script>
  $(window).on('load', function(){
    $(".preload").show(function(){
      $(".cssload-container").detach();
    });
  });
</script>
