import sqlite3

conn = sqlite3.connect("db/etuservices.db")
cursor = conn.cursor()

users = [
    ('Dupont', 'Jean', 'jean.dupont@example.com', 'motdepasse123'),
    ('Durand', 'Marie', 'marie.durand@example.com', 'motdepasse456'),
    ('Martin', 'Pierre', 'pierre.martin@example.com', 'motdepasse789'),
]

for user in users:
    cursor.execute('''
    INSERT OR IGNORE INTO utilisateurs (nom, prenom, email, mot_de_passe) 
    VALUES (?, ?, ?, ?)
    ''', user)

conn.commit()
conn.close()

print("Utilisateurs insérés avec succès.")
