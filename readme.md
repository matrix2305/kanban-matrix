## KANBAN MATRIX 2305

Application for management with tasks and your business

*** NOTE: Application can run only on linux OS ***

``Instructions to run application:``

```
1. First run ./setup.sh command
2. Than run ./prepare-db.sh to create database and populate db with seeds
```

You can login with users from seed (use username or email), password for all users are "matrix12345!"

```json
[
  {
    "id": 1,
    "name": "John Smith",
    "email": "test123@yopmail.com",
    "avatar_url": "https://i.pravatar.cc/150?u=1"
  },
  {
    "id": 2,
    "name": "Emma Watson",
    "email": "test1234@yopmail.com",
    "avatar_url": "https://i.pravatar.cc/150?u=2"
  },
  {
    "id": 3,
    "name": "Michael Johnson",
    "email": "test12345@yopmail.com",
    "avatar_url": "https://i.pravatar.cc/150?u=3"
  },
  {
    "id": 4,
    "name": "Emily Brown",
    "email": "test123456@yopmail.com",
    "avatar_url": "https://i.pravatar.cc/150?u=4"
  }
]
```

Project addresses
```
Front end application - http://localhost:9904
Rest api application - http://localhost:9900
```