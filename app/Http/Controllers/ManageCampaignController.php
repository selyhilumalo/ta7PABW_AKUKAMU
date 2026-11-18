<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManageCampaignController extends Controller
{
    // READ: daftar campaign
    public function index()
    {
        $campaigns = Campaign::latest()->get();

        return view('manage.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        $kategoris = DB::table('kategoris')->get();

        return view('manage.campaigns.create', compact('kategoris'));
    }

    // CREATE
    public function store(Request $request)
    {
        $data = $this->validated($request);
        unset($data['image']);

        $data['slug'] = $this->uniqueSlug($data['judul']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        Campaign::create($data);

        return redirect()->route('manage.campaigns.index')
            ->with('success', 'Campaign berhasil ditambahkan.');
    }

    public function edit(Campaign $campaign)
    {
        $kategoris = DB::table('kategoris')->get();

        return view('manage.campaigns.edit', compact('campaign', 'kategoris'));
    }

    // UPDATE: file lama dihapus saat gambar diganti
    public function update(Request $request, Campaign $campaign)
    {
        $data = $this->validated($request);
        unset($data['image']);

        if ($request->hasFile('image')) {
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        $campaign->update($data);

        return redirect()->route('manage.campaigns.index')
            ->with('success', 'Campaign berhasil diperbarui.');
    }

    // DELETE: file ikut dihapus dari storage
    public function destroy(Campaign $campaign)
    {
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }

        $campaign->delete();

        return redirect()->route('manage.campaigns.index')
            ->with('success', 'Campaign dan gambarnya berhasil dihapus.');
    }

    // Unduh gambar
    public function download(Campaign $campaign)
    {
        abort_unless($campaign->image && Storage::disk('public')->exists($campaign->image), 404);

        $ext = pathinfo($campaign->image, PATHINFO_EXTENSION);

        return Storage::disk('public')->download($campaign->image, Str::slug($campaign->judul) . '.' . $ext);
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'kategori_id'     => 'required|exists:kategoris,id',
            'judul'           => 'required|string|max:150',
            'deskripsi'       => 'required|string',
            'target_dana'     => 'required|integer|min:0',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status'          => 'required|in:draft,aktif,selesai',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'kategori_id.required'          => 'Pilih kategori campaign.',
            'kategori_id.exists'            => 'Kategori tidak valid.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'image.image'                   => 'File harus berupa gambar.',
            'image.mimes'                   => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'image.max'                     => 'Ukuran gambar maksimal 2 MB.',
        ]);
    }

    private function uniqueSlug(string $judul): string
    {
        $slug = Str::slug($judul);

        return Campaign::where('slug', $slug)->exists()
            ? $slug . '-' . Str::lower(Str::random(5))
            : $slug;
    }
}