import numpy as np
import joblib
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split

# Generate synthetic training data
X = np.random.randint(10, 90, (1000, 3))  # CPU, Memory, Network Load
y = np.random.randint(0, 100, 1000)  # Risk Score (0-100%)

# Train the model
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
model = RandomForestClassifier(n_estimators=100)
model.fit(X_train, y_train)

# Save the trained model
joblib.dump(model, "risk_model.pkl")

print("Model trained and saved as risk_model.pkl")
