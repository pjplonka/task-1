init:
	docker compose build --no-cache
dev:
	docker compose up --pull always -d --wait