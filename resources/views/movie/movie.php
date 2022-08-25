<div class="container-fluid">
    <div class="card m-4">
        <div class="card-body">
            <!-- <h5 class="card-title">Card title</h5> -->
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" onclick="baseList();">Update Movie List</button>
            </div>

            <form action="" onsubmit="search(); return false;" method="post" id="formSearch">
                <div class="row">

                    <div class="col">
                        <label for="basic-url" class="form-label">Search by title</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="basic-addon2" name="title">
                            <span class="input-group-text" id="basic-addon2">search</span>
                        </div>
                    </div>

                    <div class="col">
                        <label for="start_date" class="form-label">Date range</label>
                        <div class=" row mb-3">
                            <div class="col-6">
                                <input type="number" class="form-control" id="start_date" name="start_date" placeholder="YYYY" min="1960" max="<?= date('Y') ?>">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" id="end_date" name="end_date" placeholder="YYYY" min="1960" max="<?= date('Y') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <label for="start_date" class="form-label">Sort by</label>
                        <div class="mb-3">
                            <select class="form control" name="order">
                                <option>Asc</option>
                                <option>Desc</option>
                            </select>
                            <select class="form control" name="orderby">
                                <option value="Title">Title</option>
                                <option value="Year">Date</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-start mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>


            <div class="card m-2">
                <div class="card-body">
                    <table class="table table-hover table-bordered table-striped" width="100%" id="table_movies">
                        <thead>
                            <tr>
                                <th width="25%">Title</th>
                                <th width="15%">Year</th>
                                <th width="15%">Type</th>
                                <th width="45%">Poster</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo autoVersionado('movie/movie.js'); ?>"></script>

<style>
    img {
        width: 30%;
    }
</style>