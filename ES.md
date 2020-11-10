# Wildcard
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
