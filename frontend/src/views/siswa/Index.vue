<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <h4>DATA SISWA</h4>
            <hr />

            <router-link
              :to="{ name: 'siswa.create' }"
              class="btn btn-md btn-success"
            >
              TAMBAH SISWA
            </router-link>

            <table class="table table-striped table-bordered mt-4">
              <thead>
                <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Kota</th>
                  <th scope="col">Provinsi</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="siswa in posts" :key="siswa.id">
                  <td>{{ siswa.nama }}</td>
                  <td>{{ siswa.alamat }}</td>
                  <td>{{ siswa.kota }}</td>
                  <td>{{ siswa.provinsi }}</td>
                  <td>{{ siswa.email }}</td>

                  <td class="text-center">
                    <router-link
                      :to="{
                        name: 'siswa.edit',
                        params: { id: siswa.id },
                      }"
                      class="btn btn-sm btn-primary"
                    >
                      Edit
                    </router-link>

                    <button
                      type="button"
                      class="btn btn-sm btn-danger ms-1"
                      @click="deleteSiswa(siswa.id)"
                    >
                      Delete
                    </button>
                  </td>
                </tr>

                <tr v-if="posts.length === 0">
                  <td colspan="6" class="text-center">Belum ada data siswa.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";

export default {
  name: "Index",

  setup() {
    // Menyimpan daftar data siswa
    const posts = ref([]);

    // Mengambil data siswa dari API Laravel
    const getDataSiswa = () => {
      axios
        .get("http://localhost:8000/api/siswa")
        .then((response) => {
          posts.value = response.data.data ?? response.data;
        })
        .catch((error) => {
          console.error("Gagal mengambil data siswa:", error);
        });
    };

    // Menghapus data siswa berdasarkan ID
    const deleteSiswa = (id) => {
      if (confirm("Apakah Anda yakin ingin menghapus data siswa ini?")) {
        axios
          .delete(`http://localhost:8000/api/siswa/${id}`)
          .then(() => {
            // Memuat ulang daftar siswa setelah berhasil dihapus
            getDataSiswa();
          })
          .catch((error) => {
            console.error("Gagal menghapus data siswa:", error);
            alert("Data siswa gagal dihapus. Silakan periksa kembali.");
          });
      }
    };

    // Mengambil data saat halaman dibuka
    onMounted(() => {
      getDataSiswa();
    });

    return {
      posts,
      deleteSiswa,
    };
  },
};
</script>

<style>
body {
  background: lightgray;
}
</style>
