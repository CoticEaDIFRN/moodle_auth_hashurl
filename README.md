# moodle_auth_hashurl
Esse plugin permite que usuários de outro sistema específico efetuem login na plataforma, desde que sejam autenticados por meio de um token enviado pelo sistema de origem.


1. Install plugin on Moodle

```bash
cd $MOODLE_ROOT
cd auth
git clone https://github.com/CoticEaDIFRN/moodle_auth_hashurl.git hashurl
``` 

2. Access Moodle plugin validation URL https://hostname/moodlepath/admin/index.php and update database.
3. Inform plugin configuration fields ```validation_url```, ```login_url```, ```logout_url```.
4. Save and done!
