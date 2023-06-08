@extends('layouts.app')

@section('content')

<div class="text-white bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 min-h-screen min-w-full" >
        <div>
            <br><br>
            <h1 class="flex items-center justify-center">COURSE</h1>
            <ul>
                <li onclick="location.href='#section1'">1. What Is the Cryptocurrency</li>
                <li onclick="location.href='#section2'">2. How blockchain works</li>
                <li onclick="location.href='#section3'">3. When to sell</li>
                <li onclick="location.href='#section4'">4. How the factors work</li>
            </ul>

            <div class="content">
                <div class="section" id="section1">
                    <h2>1. What Is the Cryptocurrency</h2>
                    <p>
        Cryptocurrency is a digital or virtual currency created using cryptographic techniques that enable people to buy, sell, or trade them securely. Unlike fiat currencies like the U.S. dollar or the euro, cryptocurrencies are not controlled or maintained by any central authority, such as a government or bank.
        </p>
        <p>
        Cryptocurrency transactions are recorded on a blockchain network, which is a distributed public ledger. The cryptocurrencies can be bought on crypto exchanges and are stored in digital wallets.
        </p>
        <p>
        There are several benefits to cryptocurrencies, including cheaper and faster money transfers and decentralized systems that do not fail at any single point. There are, however, some disadvantages as well. Cryptocurrencies have highly volatile prices, consume a large amount of energy when mining or creating coins, and cryptocurrencies have been linked to criminal enterprises.
        </p>

                </div>

                <div class="section" id="section2">
                    <h2>2. How blockchain works</h2>
                    <p>
            A blockchain is a distributed database or ledger that is shared among the nodes of a computer network. It is a system in which information is recorded in a way that makes it difficult or impossible to change or cheat it.
            </p>
            <p>
            Each block in the chain contains a number of transactions, and every time a new transaction occurs on the blockchain, a record of that transaction is added to every participant’s ledger. Decentralized databases that are managed by multiple participants are known as distributed ledger technology. The network is, therefore, secure because if one block is changed, it is immediately noticeable.
            </p>
            <p>
            Among the most prominent uses of blockchains is in cryptocurrency systems for keeping track of transactions in a secure and decentralized way. As blocks are continually added to blockchains like Bitcoin and Ethereum, the security of the ledger is significantly enhanced.
            </p>
            <p>
            Using a blockchain guarantees the integrity and security of data records without the involvement of a third party. Blockchain technology can be used for a variety of other applications besides cryptocurrency, including tracking health care records, verifying education credentials, buying and selling real estate, and much more.
            </p>
            <p>
            Due to its wide range of use, blockchain has been called a pillar of the Fourth Industrial Revolution, comparable to technology such as the steam engine and the internet that contributed to previous industrial revolutions and changed the world.
            </p>
                </div>

                <div class="section" id="section3">
                    <h2>3. When to sell</h2>
                    <p>
            Theoretically, the ability to make money on stocks involves two key decisions: buying at the right time and selling at the right time. To make a profit, you have to execute both of these decisions correctly.
            </p>
            <p>
            Buying a stock is relatively easy, but selling it is usually a more difficult decision to make. If you sell too early and the stock goes higher, you risk leaving gains on the table. If you sell too late and the stock plunges, you’ve probably missed your opportunity. What’s an investor to do?
            </p>
            <p>
            Many investors have trouble selling a stock, and sometimes the reason is rooted in the innate human tendency toward greed. However, there are strategies that you can use to identify when it is (and isn’t) a good time to sell.
            </p>
                </div>

                <div class="section" id="section4">
                    <h2>4. How the factors work</h2>
                    <p>
        In our simulation, we have several key factors that affect the share price and that should be taken into account when making trading decisions:</p>
        <ol>
            <li>"stabilityIndex" it is a factor that represents how stable a stock's price is. If the index value is high, the share price changes more smoothly and predictably. On the other hand, if the value is low, the share price can be more volatile, with large swings up and down.</li>
            <li>"crashLikelihood" it is a factor that determines the probability that the stock will experience a large drop in price. The higher the value of this parameter, the more likely the stock will experience a significant price decrease.</li>
            <li>"economicWeight" it is a factor that determines how much influence the economy has on the share price. It can include any number of economic factors, such as overall economic activity, unemployment rates, inflation, interest rates, corporate earnings, consumer income, and more. If the "economicWeight" is high, it means that the economic conditions have a large influence on the share price.</li>
            <li>"socialWeight" it is a factor that shows how much social factors affect the share price. This can include everything from public opinion and consumer sentiment to social movements and changes in demographics. For example, if a company is involved in a scandal that leads to negative social reactions, this can affect the share price, and if the "socialWeight" is high, then this influence would be more significant.</li>
            <li>"popularityWeight" it is the factor that determines how much influence the popularity of the company or its product has on the share price. If the company offers a product or service that becomes extremely popular, this can raise the share price and. With a high value of "popularityWeight", such changes in popularity would have a large impact on the share price.</li>
            <li>"restrictionWeight" it is a factor that indicates how much regulatory restrictions can affect the share price. This includes laws and regulations that restrict the company's operations, such as environmental regulations, competition laws, levies and fees, and other forms of government regulation. If the "restrictionWeight" is high, then changes in these regulations would have a large impact on the share price.</li>
        </ol>
        <p>
        These factors can affect the share price by giving a chance for different events to happen. Events such as wars, regulatory restrictions or technological innovations can change the share price dramatically. It is possible to have more than one event in one round of the simulation.All these parameters and events are used to calculate the new price of the cryptocurrency based on random factors and their weight values. Your ending balance as an investor is calculated as the difference between your opening balance and ending balance, plus the value of the cryptocurrency you currently own. This means that your profit on the investment depends on how the prices of the cryptocurrencies you bought change within the simulation.
    </p>
        
                </div>
            </div>
            
        </div>
       
</div>
@endsection
