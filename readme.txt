nggo nambahke hapus otomatis kudu setting ng windows.
carane:
1. search "Task Scheduler"
2. create basic Task
3. Isi jenenge, misal "Laravel Scheduler"
NEXT
4. pilih daily, atur jam ng 00:01:00
NEXT
5. pilih start a program
NEXT
nggon bagian Program/script isinen "cmd" tanpa tanda petik
nggon bagian Add arguments isinen path direktori foldermu (nek nganggo xampp brarti htdocs), contoh:
/c "cd /d D:\Downloads\laragon\www\fitran\Antrian && php artisan schedule:run"
NEXT
FINISH

misal meh menguji ng terminal: php artisan antrian:hapus-kadaluarsa