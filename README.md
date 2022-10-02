# CRUD REST API for Users
For start work you must using the following command:
```bash
php artisan migrate --seed
```
After that, the file called bearer_token.txt will appear in the root of the project. It will contain a bearer token with which you can start working with the REST API

Api methods

- GET             api/users - Get users list with paginate
- POST            api/users - Create user
- GET             api/users/{user_id} - Get user
- PUT|PATCH       api/users/{user} - Update user
- DELETE          api/users/{user} - Delete user

User fields that you can work with:
- name
- email
- password
