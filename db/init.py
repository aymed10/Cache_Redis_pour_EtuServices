import sqlite3

conn = sqlite3.connect("db/etuservices.db")
c = conn.cursor()

c.execute('''
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    prenom TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    mot_de_passe TEXT NOT NULL
)
''')

conn.commit()
conn.close()

print("Base de données initialisée avec succès.")
