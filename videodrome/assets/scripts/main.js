$(document).ready(function() {
    $('.film-grid').on('click', '.add-to-playlist', function(event) {
        event.preventDefault();
        
        
        const filmId = $(this).data('film-id');  // Note le changement ici
        const playlistId = $(this).data('playlist-id');  // Et ici
        
        console.log("filmId à envoyer :", filmId);
console.log("playlistId à envoyer :", playlistId);

        
        $.ajax({
            url: 'ajouter-au-playlist.php',
            type: 'POST',
            data: {
                filmId: filmId,
                playlistId: playlistId
            },
            success: function(response) {
                console.log('Server response:', response);
                location.reload();
            },
            
            error: function() {
                console.error('Erreur lors de la requête AJAX');
            }
            
        });
      
  
    });
});