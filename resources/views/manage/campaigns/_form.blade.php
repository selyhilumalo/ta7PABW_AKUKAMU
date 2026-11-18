@csrf

<label for="judul">Judul campaign</label>
<input id="judul" name="judul" value="{{ old('judul', $campaign->judul ?? '') }}">
@error('judul') <div class="error">{{ $message }}</div> @enderror

<label for="kategori_id">Kategori</label>
<select id="kategori_id" name="kategori_id">
    <option value="">Pilih kategori</option>
    @foreach ($kategoris as $k)
        <option value="{{ $k->id }}" @selected((string) old('kategori_id', $campaign->kategori_id ?? '') === (string) $k->id)>
            {{ $k->nama ?? $k->name ?? $k->nama_kategori ?? $k->judul ?? ('Kategori #' . $k->id) }}
        </option>
    @endforeach
</select>
@if ($kategoris->isEmpty())
    <div class="error">Tabel kategoris masih kosong. Isi dulu minimal satu kategori.</div>
@endif
@error('kategori_id') <div class="error">{{ $message }}</div> @enderror

<label for="deskripsi">Deskripsi</label>
<textarea id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $campaign->deskripsi ?? '') }}</textarea>
@error('deskripsi') <div class="error">{{ $message }}</div> @enderror

<label for="target_dana">Target dana (Rp)</label>
<input id="target_dana" type="number" name="target_dana" min="0" value="{{ old('target_dana', $campaign->target_dana ?? '') }}">
@error('target_dana') <div class="error">{{ $message }}</div> @enderror

<label for="tanggal_mulai">Tanggal mulai</label>
<input id="tanggal_mulai" type="date" name="tanggal_mulai"
       value="{{ old('tanggal_mulai', isset($campaign) ? $campaign->tanggal_mulai?->format('Y-m-d') : '') }}">
@error('tanggal_mulai') <div class="error">{{ $message }}</div> @enderror

<label for="tanggal_selesai">Tanggal selesai (opsional)</label>
<input id="tanggal_selesai" type="date" name="tanggal_selesai"
       value="{{ old('tanggal_selesai', isset($campaign) ? $campaign->tanggal_selesai?->format('Y-m-d') : '') }}">
@error('tanggal_selesai') <div class="error">{{ $message }}</div> @enderror

<label for="status">Status</label>
<select id="status" name="status">
    @foreach (['aktif' => 'Aktif', 'draft' => 'Draft', 'selesai' => 'Selesai'] as $value => $label)
        <option value="{{ $value }}" @selected(old('status', $campaign->status ?? 'aktif') === $value)>{{ $label }}</option>
    @endforeach
</select>
@error('status') <div class="error">{{ $message }}</div> @enderror

<label for="image">Gambar campaign (jpg, png, webp, maks 2 MB)</label>
@if (! empty($campaign->image))
    <p>
        <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->judul }}" class="thumb">
        <br><span class="muted">Gambar saat ini. Pilih file baru untuk menggantinya.</span>
    </p>
@endif
<input id="image" type="file" name="image" accept="image/png,image/jpeg,image/webp">
@error('image') <div class="error">{{ $message }}</div> @enderror

<p>
    <button type="submit" class="btn">Simpan</button>
    <a href="{{ route('manage.campaigns.index') }}">Batal</a>
</p>