<!-- Button trigger modal
<button type="button" class="btn btn-primary">
    Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forum/partials/handle_Login.php" method = "post">
            <div class="modal-body">
                
                    <div class="row mb-3">
                        <label for="loginEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="loginEmail" name="loginEmail">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="loginPass" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="loginPass" name="loginPass">
                        </div>
                    </div>
                   
                
                    <button type="submit" class="btn btn-primary">Log in</button>
                
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>