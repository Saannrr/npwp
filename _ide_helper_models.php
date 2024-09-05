<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\DokumenPphPasal
 *
 * @property int $id
 * @property int $user_id
 * @property string $nama_dokumen
 * @property string $no_dokumen
 * @property string $tgl_dokumen
 * @property int $pphpasal_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\PphPasal $pphpasal
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal query()
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal whereNamaDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal whereNoDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal wherePphpasalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal whereTglDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DokumenPphPasal withoutTrashed()
 */
	class DokumenPphPasal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IdentitasOrang
 *
 * @property int $id
 * @property string $nama
 * @property string $nip
 * @property string $jabatan
 * @property string $npwp
 * @property string $nik
 * @property string $alamat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang query()
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereNpwp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasOrang whereUpdatedAt($value)
 */
	class IdentitasOrang extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IdentitasPerusahaan
 *
 * @property int $id
 * @property string $nama_perusahaan
 * @property string $npwp_perusahaan
 * @property string $nik_perusahaan
 * @property string $kategori_perusahaan
 * @property string $alamat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan query()
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan whereKategoriPerusahaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan whereNamaPerusahaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan whereNikPerusahaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan whereNpwpPerusahaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IdentitasPerusahaan whereUpdatedAt($value)
 */
	class IdentitasPerusahaan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ObjekPajak
 *
 * @property int $id
 * @property string $kode_pajak
 * @property string $nama_pajak
 * @property string $persen
 * @property string|null $netto
 * @property string $jenis
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak query()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak whereKodePajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak whereNamaPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak whereNetto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak wherePersen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ObjekPajak withoutTrashed()
 */
	class ObjekPajak extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PajakPenghasilan
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $pengaturan_id
 * @property string|null $jenis_bukti_penyetoran
 * @property string|null $nomor_bukti
 * @property string|null $nomor_pemindahbukuan
 * @property string|null $masa_pajak
 * @property string|null $tahun_pajak
 * @property string|null $jenis_pajak
 * @property string|null $jenis_setoran
 * @property string|null $kode_objek_pajak
 * @property int|null $jumlah_penghasilan_bruto
 * @property int|null $jumlah_setor
 * @property string|null $tanggal_setor
 * @property string|null $nama
 * @property string|null $identitas
 * @property string|null $npwp_id
 * @property string|null $nik_id
 * @property string|null $penandatangan_bukti_potong
 * @property int|null $dokumen_pph_pasal_id
 * @property string|null $fasilitas_pajak
 * @property string|null $no_fasilitas
 * @property string|null $kelebihan_pemotongan
 * @property string $status
 * @property string|null $tin
 * @property string|null $alamat
 * @property string|null $negara
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property string|null $no_pasport
 * @property string|null $no_kitas
 * @property string|null $netto
 * @property string|null $tarif
 * @property string|null $pernyataan
 * @property int $is_posted
 * @property string|null $posting_date
 * @property string|null $tipe_pph
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan query()
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereDokumenPphPasalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereFasilitasPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereIdentitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereIsPosted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereJenisBuktiPenyetoran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereJenisPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereJenisSetoran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereJumlahPenghasilanBruto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereJumlahSetor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereKelebihanPemotongan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereKodeObjekPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereMasaPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNegara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNetto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNikId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNoFasilitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNoKitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNoPasport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNomorBukti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNomorPemindahbukuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereNpwpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan wherePenandatanganBuktiPotong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan wherePengaturanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan wherePernyataan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan wherePostingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereTahunPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereTanggalSetor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereTarif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereTempatLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereTipePph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PajakPenghasilan whereUserId($value)
 */
	class PajakPenghasilan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PembayaranSpt
 *
 * @property int $id
 * @property int $user_id
 * @property string $npwp_id
 * @property string $nama_wp
 * @property string $alamat_wp
 * @property string $ntpn
 * @property string $kode_billing
 * @property string $kode_jenis_pajak
 * @property string $kode_jenis_setoran
 * @property int $pph_yang_dipotong
 * @property int $jumlah_setor
 * @property string $masa_pajak
 * @property string $tahun_pajak
 * @property string $nop
 * @property string $nomor_ketetapan
 * @property string $uraian
 * @property string $nama_bank
 * @property string $nomor_transaksi_bank
 * @property string $npwp_penyetor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt query()
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereAlamatWp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereJumlahSetor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereKodeBilling($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereKodeJenisPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereKodeJenisSetoran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereMasaPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereNamaBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereNamaWp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereNomorKetetapan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereNomorTransaksiBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereNop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereNpwpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereNpwpPenyetor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereNtpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt wherePphYangDipotong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereTahunPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereUraian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PembayaranSpt whereUserId($value)
 */
	class PembayaranSpt extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pengaturan
 *
 * @property int $id
 * @property string $bertindak_sebagai
 * @property string $identitas
 * @property string|null $npwp_id
 * @property string|null $nik_id
 * @property string $nama_penandatangan
 * @property int $user_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\IdentitasOrang|null $pegawai
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PphPasal> $pph_pasal
 * @property-read int|null $pph_pasal_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereBertindakSebagai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereIdentitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereNamaPenandatangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereNikId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereNpwpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan withoutTrashed()
 */
	class Pengaturan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PerekamanBp
 *
 * @property int $id
 * @property int $user_id
 * @property int $pajak_penghasilan_id
 * @property string $tahun_pajak
 * @property string $masa_pajak
 * @property string $jenis_pajak
 * @property string $jenis_setoran
 * @property int|null $pph_yang_dipotong
 * @property string|null $id_billing
 * @property int|null $pph_yang_disetor
 * @property int|null $selisih
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp query()
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereIdBilling($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereJenisPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereJenisSetoran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereMasaPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp wherePajakPenghasilanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp wherePphYangDipotong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp wherePphYangDisetor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereSelisih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereTahunPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerekamanBp whereUserId($value)
 */
	class PerekamanBp extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostingPph
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $pph
 * @method static \Illuminate\Database\Eloquent\Builder|PostingPph newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostingPph newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostingPph onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PostingPph query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostingPph withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PostingPph withoutTrashed()
 */
	class PostingPph extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PphPasal
 *
 * @property int $id
 * @property int $user_id
 * @property int $pengaturan_id
 * @property string $penandatangan_bukti_potong
 * @property string $tahun_pajak
 * @property string $masa_pajak
 * @property string $nama
 * @property string $identitas
 * @property string|null $npwp_id
 * @property string|null $nik_id
 * @property int $dokumen_pph_pasal_id
 * @property \App\Models\ObjekPajak $kode_objek_pajak
 * @property string $fasilitas_pajak_penghasilan
 * @property string|null $no_fasilitas
 * @property int $jumlah_penghasilan_bruto
 * @property string $tarif
 * @property int $jumlah_setor
 * @property string $kelebihan_pemotongan
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DokumenPphPasal> $dokumen_pph_pasal
 * @property-read int|null $dokumen_pph_pasal_count
 * @property-read \App\Models\IdentitasPerusahaan|null $identitas_perusahaan_yang_dipotong
 * @property-read \App\Models\Pengaturan $pengaturan
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal query()
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereDokumenPphPasalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereFasilitasPajakPenghasilan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereIdentitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereJumlahPenghasilanBruto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereJumlahSetor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereKelebihanPemotongan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereKodeObjekPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereMasaPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereNikId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereNoFasilitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereNpwpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal wherePenandatanganBuktiPotong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal wherePengaturanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereTahunPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereTarif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PphPasal withoutTrashed()
 */
	class PphPasal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RekamSptBp
 *
 * @property int $id
 * @property int $user_id
 * @property string $jenis_bukti_penyetoran
 * @property string $npwp_id
 * @property string|null $ntpn_id
 * @property string|null $nomor_pemindahbukuan
 * @property string $tahun_pajak
 * @property string $masa_pajak
 * @property string $jenis_pajak
 * @property string $jenis_setoran
 * @property int $jumlah_setor
 * @property int $pph_yang_dipotong
 * @property string $tanggal_setor
 * @property int $beda_npwp_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp query()
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereBedaNpwpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereJenisBuktiPenyetoran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereJenisPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereJenisSetoran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereJumlahSetor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereMasaPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereNomorPemindahbukuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereNpwpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereNtpnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp wherePphYangDipotong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereTahunPajak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereTanggalSetor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekamSptBp whereUserId($value)
 */
	class RekamSptBp extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $passphrase
 * @property string $role
 * @property int $profileable_id
 * @property string $profileable_type
 * @property string|null $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $token_expires_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pengaturan> $pengaturan
 * @property-read int|null $pengaturan_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $profileable
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassphrase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTokenExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable {}
}

