# Wildcard
```
{
  "sort": [
    {
      "created_at": "desc"
    }
  ],
  "query": {
    "bool": {
      "must": [
        {
          "term": {
            "user_id": 8888
          }
        },
        {
          "wildcard": {
            "message": {
              "value": "*flutter*",
              "boost": 1,
              "rewrite": "constant_score"
            }
          }
        }
      ]
    }
  }
}
```

# Search by user id
```
{
  "sort": [
    {
      "created_at": "asc"
    }
  ],
  "size": 100,
  "query": {
    "bool": {
      "must": [
        {
          "term": {
            "user_id": 111
          }
        }
      ]
    }
  }
}
```
