<div id="second-contestant">
    <div class="form-group row">
        <label for="second-contestant-name" class="col-sm-4 col-form-label">2. mängija nimi</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="second-contestant-name" placeholder="Sisesta mängija nimi"
            name="person_2_name" autocomplete="off" value="{{ $contestants[1]->name }}" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="second-contestant-email" class="col-sm-4 col-form-label">2. mängija meiliaadress</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" id="second-contestant-email" placeholder="Sisesta meiliaadress"
            name="person_2_email" autocomplete="off" value="{{ $contestants[1]->email }}" required>
        </div>
    </div>
</div>