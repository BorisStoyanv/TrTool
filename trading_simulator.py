import os
import random
import json

class TradingSimulator:
    def __init__(self, num_rounds=10, initial_balance=1000, rank_filename="ranks.json"):
        self.num_rounds = num_rounds
        self.initial_balance = initial_balance
        self.rank_filename = rank_filename
        self.stock_price = 0
        self.shares = 0
        self.balance = initial_balance
        self.ranks = self.load_ranks()

    def load_ranks(self):
        if os.path.exists(self.rank_filename):
            with open(self.rank_filename, "r") as file:
                return json.load(file)
        return {}

    def save_ranks(self):
        with open(self.rank_filename, "w") as file:
            json.dump(self.ranks, file)

    def update_rank(self, username, profit):
        if username not in self.ranks:
            self.ranks[username] = 0
        self.ranks[username] = max(self.ranks[username], profit)
        self.save_ranks()

    def get_random_stock_price(self):
        return random.randint(10, 200)

    def print_balance(self):
        print(f"Balance: ${self.balance:.2f}, Shares: {self.shares}, Stock Price: ${self.stock_price:.2f}")

    def buy(self, amount):
        cost = amount * self.stock_price
        if cost <= self.balance:
            self.balance -= cost
            self.shares += amount

    def sell(self, amount):
        if amount <= self.shares:
            revenue = amount * self.stock_price
            self.balance += revenue
            self.shares -= amount

    def play(self):
        username = input("Enter your username: ")

        for round in range(1, self.num_rounds + 1):
            self.stock_price = self.get_random_stock_price()
            print(f"Round {round}/{self.num_rounds}")
            self.print_balance()

            action = input("Choose action (buy/sell/hold): ").lower()
            if action == "buy" or action == "sell":
                amount = int(input("Enter the number of shares: "))
                if action == "buy":
                    self.buy(amount)
                else:
                    self.sell(amount)

        profit = self.balance - self.initial_balance
        print(f"Final profit: ${profit:.2f}")
        self.update_rank(username, profit)

        print("Current ranks:")
        for user, rank in sorted(self.ranks.items(), key=lambda x: x[1], reverse=True):
            print(f"{user}: ${rank:.2f}")

if __name__ == "__main__":
    simulator = TradingSimulator()
    simulator.play()