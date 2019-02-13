<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

          {{-- bootstrap cdn --}}
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

       
    </head>
    <body>

         <button id="add-item" class="btn btn-block btn-primary" data-toggle="modal" data-target="#newItem"> Create a new item </button>

        <div class="modal" id="newItem">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create a New Item</h4>
                    </div>

                    <div class="modal-body">
                        <form id="create-item">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" placeholder="new item">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input id="description" type="text" class="form-control" name="description">
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input id="price" type="number" class="form-control" name="price">
                            </div>

                            <button id="createButton" class="btn btn-block btn-primary" data-dismiss="modal">Create New Item</button>
                           
                        </form> {{-- end of create new item --}}
                    </div>
                </div>
            </div>
        </div> {{-- end modal --}}

        {{-- this is the front end --}}
        <ul id="itemList">
            
        </ul>

        <script>
            {{-- create a new item --}}
            document.getElementById("createButton").onclick = function() {
                // alert("hello");
                //form data converts the form data
                let formData = new FormData();
                let nameFiled = document.querySelector("#name")
                let description = document.querySelector("#description")
                let price = document.querySelector("#price")

                formData.name = nameFiled.value;
                formData.description = description.value;
                formData.price = price.value;

                console.log(formData);

                fetch('http://localhost:3000/items/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type' : 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(res=> res.json() )
                .catch(error => console.error('Error:' ,  error))
                .then(res=>console.log('Success:' , JSON.stringify(res) ));
            }


            const url = 'http://localhost:3000/items/'
            fetch(url, {
                method: 'GET',
                headers: {
                        'Content-Type' : 'application/json'
                    }
            }).then(res=> {
                return res.json();
            }).then(data => {
                console.log(data.data.items)

                const items = data.data.items

                let itemGroups = ' ';
                items.map( item => {
                    itemGroups += `
                    <hr>
                        <li>${item.name}</li>
                        <li>${item.description}</li>
                        <li>${item.price}</li>
                    `
                })


            document.querySelector('#itemList').innerHTML = itemGroups;
            });
       </script>
   </body>
</html>
