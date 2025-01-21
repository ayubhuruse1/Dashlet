import sys
import numpy as np
import joblib

# Load pre-trained ML model
model = joblib.load("risk_model.pkl")

def predict_risk(host_name):
    # Generate dummy feature data (Replace with real Nagios metrics)
    cpu_usage = np.random.randint(10, 90)
    mem_usage = np.random.randint(10, 90)
    network_load = np.random.randint(10, 90)

    # Make prediction
    features = np.array([[cpu_usage, mem_usage, network_load]])
    risk_score = model.predict(features)[0]

    return int(risk_score)

if __name__ == "__main__":
    host_name = sys.argv[1]
    print(predict_risk(host_name))
