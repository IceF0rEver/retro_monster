<footer class="bg-gray-900 text-gray-300 py-8">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 RetroMonsters. Tous droits réservés.</p>
    </div>
</footer>
<script>
  $(document).ready(function () {
      $('#submit-comment').click(function () {
          var commentContent = $('#comment-content').val();

          if (commentContent.trim() !== '') {
              $.ajax({
                  type: 'POST',
                  url: '{{ route('comment.store') }}',
                  data: {
                      _token: '{{ csrf_token() }}',
                      content: commentContent
                  },
                  success: function (data) {
                      $('#commentaires-section').append(data);

                      $('#comment-content').val('');
                  },
                  error: function (data) {
                      console.log('Erreur lors de la soumission du commentaire.');
                  }
              });
          }
      });
  });
</script>