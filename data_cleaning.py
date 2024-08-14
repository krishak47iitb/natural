import pandas as pd

# Load the CSV file (replace with your actual file path)
file_path = r'C:\Users\Bing\Desktop\Dan\dataset\data.csv'   
df = pd.read_csv(file_path)

# Create the new column "url" (replace the bingo with the name of your zone)
df['url'] = 'https://bingo.uqcloud.net/img/' + df['id'].astype(str) + '.jpg'

# Create the new column "fetch_count", with default value 0
df['fetch_count'] = 0

# Create the new column "elo_rating", with default value 1000
df['elo_rating'] = 1000

# Save the updated DataFrame back to a CSV file
df.to_csv('updated_csv_file.csv', index=False)
