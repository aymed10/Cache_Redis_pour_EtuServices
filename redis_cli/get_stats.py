import redis

r = redis.Redis(host='localhost', port=6379, db=0)

top_users = r.zrevrange("stats_connexions", 0, 2, withscores=True)

for email, score in top_users:
    print(f"{email.decode()}:{int(score)}")
