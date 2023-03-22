import random
import matplotlib.pyplot as plt

class Player:
    def __init__(self, name, money):
        self.name = name
        self.money = money
        self.coins = 0
        
    def buy(self, price):
        max_coins = self.money // price
        if max_coins > 0:
            coins_to_buy = random.randint(1, max_coins)
            self.money -= coins_to_buy * price
            self.coins += coins_to_buy
        
    def sell(self, price):
        if self.coins > 0:
            coins_to_sell = random.randint(1, self.coins)
            self.money += coins_to_sell * price
            self.coins -= coins_to_sell
        
    def hold(self):
        pass
        
class CryptoGame:
    def __init__(self, players):
        self.players = players
        self.prices = []
        self.rounds = 10
        
    def play(self):
        for i in range(self.rounds):
            price_change = random.randint(-50, 50) / 100
            current_price = 100 + (100 * price_change)
            self.prices.append(current_price)
            
            for player in self.players:
                action = input(f"{player.name}, enter 'buy', 'sell', or 'hold': ")
                while action not in ['buy', 'sell', 'hold']:
                    action = input(f"{player.name}, enter 'buy', 'sell', or 'hold': ")
                if action == 'buy':
                    player.buy(current_price)
                elif action == 'sell':
                    player.sell(current_price)
                else:
                    player.hold()
        
        player_profits = {}
        for player in self.players:
            final_value = player.money + (player.coins * self.prices[-1])
            player_profits[player.name] = final_value - 1000
        
        sorted_profits = sorted(player_profits.items(), key=lambda x: x[1], reverse=True)
        winner = sorted_profits[0][0]
        print(f"The winner is {winner} with a profit of ${player_profits[winner]:.2f}")
        
        plt.plot(self.prices)
        plt.title("Crypto Prices")
        plt.xlabel("Round")
        plt.ylabel("Price ($)")
        plt.show()