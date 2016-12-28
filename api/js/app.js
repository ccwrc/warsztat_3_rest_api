
$(document).ready(function() {
    
    var endpoint = "http://localhost/warsztat_3_rest_api/api/books.php";
    // var endpoint = window.location + '/api/books.php'; not work on local
    
    function showBookDetails() {
        var display = $(this);  console.log("elo"+display+"elo");
        $.ajax({
            url: endpoint,
            data: 'id=' + $(this).get(0).id,
            type: "GET",
            dataType: "json"
        })
                .done(function(json) {
                    console.log(json);
                    var bookDetails = json; 
                    display.append("<div class='displayBook'> Autor: " + bookDetails.bookauthor + "<br/> Opis: " 
                            + bookDetails.bookdescription + '<form class="editBook"> Edycja książki: \n\
                            <br/>' + '<input size="100" type="text" name="title" value="' + bookDetails.booktitle +
                            '"/><br/>' + '<input size="100" type="text" name="author" value="' 
                            + bookDetails.bookauthor + '"/><br/>' + '<input size="100" type="text" name="description" value="' 
                            + bookDetails.bookdescription + '"/><br/>' + '<input type="submit" \n\
                            class="edit" value="Edytuj książkę"\n\
                            name="' + bookDetails.bookid + '"/></form> <button class="delete" value="' + bookDetails.bookid + '">Lub usuń książkę</button><br/></div><br/>' );
                    
                    $('.delete').click(deleteBook);
                    $('.editBook').on('submit', function(e) {
                        e.preventDefault();
                        editBook(this)
                    });
                });
    }
    
    function deleteBook() {
        var bookToDelete = $(this).attr('value');
        console.log(bookToDelete);
        $.ajax({
            url: endpoint,
            data: 'id=' + bookToDelete,
            type: "DELETE",
            dataType: "json"
        })
                .done(function(json) {
                    location.reload(true);
                })
                .fail(function() {
                    alert("Książka się opiera, spróbuj później");
                });
    }
    
    function editBook(form) {
        
        var bookToEdit = {
            id: $(form).find('.edit').attr('name'),
            title: $(form).find('[name=title]').val(),
            author: $(form).find('[name=author]').val(),
            description: $(form).find('[name=description]').val()
        };
        
        $.ajax({
            url: endpoint,
            data: bookToEdit,
            type: "PUT",
            dataType: "json"
        })
                .done(function(json) {
                    alert("Zapisano edytowane dane");
                    location.reload(true);
                })
                .fail(function() {
                    alert("Książka się opiera, spróbuj później");
                });
    }
    
    // add book (works) 
    $('form[name="addBook"]').on('submit', function(e) {
        e.preventDefault();
        
        var indexForm = {
            'title': $('input[name=title]').val(),
            'author': $('input[name=author]').val(),
            'description': $('input[name=description]').val()
        };

        $.ajax({
            url: endpoint,
            data: indexForm,
            type: "POST",
            dataType: "json"
        })
                .done(function(json) {
                    alert("Książka dodana");
                    window.location.reload(true);
                })
                .fail(function() {
                    alert("Błąd dodawania książki, spróbuj ponownie później");
                });
    });
    
    // show title (works)  
    $.ajax({
        url: endpoint,
        data: {},
        type: "GET",
        dataType: "json"
    })
            .done(function(json) {
                var books = json;
                $.each(books, function(object, book) {
                    var book = $("<div id='" + book.bookid + "''class='displayBook'>" + book.booktitle 
                            + "</div>");
                    $('.booksList').append(book);
                });
                
                var title = $('.booksList div');
                title.one('click', showBookDetails);
            })
            
            .fail(function() {
                alert("Baza książek jest pusta");
            });
    

    
});
