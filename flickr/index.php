<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Flickr Search</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<style>
		#search-form {
			width: 300px;
		}
	</style>
	<script>
		var key = '403d5274ed5eb1c0131d74485aaa30dd';
		var base_url = "https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=" + key + "&format=json&nojsoncallback=1";


		$(document).ready(function () {var displayPhotos = function (photos) {  // function to grab photos from url into an array and attach them to created div and appends them.
				if(photos.length > 0){               // if photo array is greater than 0
					$('#photo-list').html('');       // clears the html of photo-list div 
				}else{                               // else
					$('#photo-list').html('No Photos Found'); // give an error in the div no photo found
				}
				for (var index in photos) {          // loops through the photo array
					var photoObj = photos[index];    // set variable for the position of the array
					var url = 'https://farm' + photoObj.farm + '.staticflickr.com/' + photoObj.server + '/' + photoObj.id + '_' + photoObj.secret + '.jpg'
					                                 // variable for the url to grab each photo
                    var img = $('<img/>').attr('src', url).width(250);     // create an img tag with src and url and width of 250 of image
					$('#photo-list').append(img);                          // append the created img to photo-div
				}
			}

			$('body').on('click', '#search-btn', function () { // function to get the photos from the url with the key. on click 
				var val = $('#search').val();                  // create a variable to get the value of search input
				var search_url = base_url + "&text=" + val;    // create a variable to add the url + the &text and the value from input
				var photos = [];                               // created photo array thats being called in the displayPhotos function

				$('#photo-list').html('Searching');            // display text to html
				$.ajax({                                        
					url: search_url,
					dateType: 'json',
					crossDomain: true,
					success: function (response) {
						photos = response.photos.photo;
						displayPhotos(photos);
					},
					error: function (response) {
						console.error(response);
					}
				});


			});
		});
	</script>

</head>

<body>
	<div id="search-form">
		<div class="panel panel-default panel-primary">
			<div class="panel-heading">Search Flickr</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon glyphicon glyphicon-search"></span>
						<input id="search" type="text" class="form-control" placeholder="Search" name="search" />
					</div>
				</div>
				<button id="search-btn" class="btn btn-lrg btn-default pull-right">Search</button>
			</div>
		</div>
	</div>
	<div id="photo-list">
	</div>
</body>

</html>