from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time
# Código para conferir se o login está funcionando. 
# Caminho para o ChromeDriver
driver_path = r'C:\xampp\htdocs\sisAuth\chromedriver\win64-130.0.6723.58\chromedriver-win64\chromedriver.exe'

# Iniciar o serviço do ChromeDriver
service = Service(driver_path)

# Criar uma nova instância do Chrome
driver = webdriver.Chrome(service=service)

# Abrir a página de login
driver.get('http://localhost:8000/login')


# Encontra os campos de email e senha e faz o login
email_field = driver.find_element(By.NAME, 'email')
password_field = driver.find_element(By.NAME, 'password')

# Informa as credenciais para autenticação
email_field.send_keys('junior.bandeira@gmail.com')  # Substitua pelo email do usuário
password_field.send_keys('bandeira')  # Substitua pela senha do usuário

# Envia o formulário
password_field.send_keys(Keys.RETURN)

# Aguarda um momento para visualizar a página após o login
time.sleep(5)

# Fecha o navegador
driver.quit()
