import redis
import time
import sys

r = redis.Redis(host='localhost', port=6379, db=0)

email = sys.argv[1]

user_key = f"connexions:{email}"

current_time = int(time.time())
r.zremrangebyscore(user_key, 0, current_time - 600)

r.zadd(user_key, {current_time: current_time})

connections_count = r.zcard(user_key)

if connections_count <= 10:
    print(f"L'utilisateur {email} peut se connecter.")
else:
    print(f"L'utilisateur {email} a dépassé le quota de connexions.")
